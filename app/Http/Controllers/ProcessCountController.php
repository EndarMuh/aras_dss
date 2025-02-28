<?php

namespace App\Http\Controllers;

use App\Models\ArasResult;
use App\Models\ListDSS;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\AlternativeCriteria;

class ProcessCountController extends Controller
{
    public function storeDecMatrix(Request $request)
    {
        $dss = ListDSS::find($request->input('dssId'));

        try {
            $matrixData = $request->input('matrix');
            $flagUpdate = 0;
            // Proses dan simpan data matriks keputusan ke dalam database
            foreach ($matrixData as $alternativeId => $criteriaData) {
                foreach ($criteriaData as $criteriaId => $value) {
                    if($dss->isCounted){
                        $flagUpdate = 1;
                        // update prevous value
                        AlternativeCriteria::where('alternative_id', $alternativeId)
                            ->where('criteria_id', $criteriaId)
                            ->update(['value' => $value]);

                    }else{
                        AlternativeCriteria::create([
                            'alternative_id' => $alternativeId,
                            'criteria_id' => $criteriaId,
                            'value' => $value,
                        ]);
                    }
                }
            }
            // $listDss->isPrepared = true;
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('user.calculate-dss', [
            'dssId' => $request->input('dssId'), $flagUpdate
        ]);
    }

public function calculateAras($dssId, $flagUpdate = 0)
    {
        // 1. mengambil semua kriteria dan alternatif berdasar dssId
        $alternatives = Alternative::where('dss_id', $dssId)
            ->orderBy('id', 'asc')
            ->get();
        $criterias = Criteria::where('dss_id', $dssId)
            ->orderBy('id', 'asc')
            ->get();

        $altzeroId = Alternative::where('dss_id', $dssId)
            ->where('name_alternative', 'alternatif-0')
            ->pluck('id');

        // 2. convert alternative 0 ke integer
        $altzeroId = $altzeroId[0];

        // 3. membuat array untuk menyimpan skor ARAS
        $arasScores = [];

        // 4. buat array untuk menyimpan nilai maks dan min
        $maxMinValues = [];

        // 5. cari nilai maksimum untuk kriteria benefit dan minimum untuk kriteria cost
        foreach ($criterias as $cr) {
            $values = AlternativeCriteria::where('criteria_id', $cr->id)->pluck(
                'value'
            );
            $maxMinValues[$cr->id] =
                $cr->category == 'Benefit' ? $values->max() : $values->min();
        }

        // 6. tambahkan nilai maksimum dan minimum ke matriks keputusan
        foreach ($maxMinValues as $criterionId => $value) {
            AlternativeCriteria::create([
                'alternative_id' => $altzeroId,
                'criteria_id' => $criterionId,
                'value' => $value,
            ]);
        }

        // 7. Loop melalui alternative untuk menjumlahkan nilai keputusan dari masing-masing kriteria
        $sumCriteria = [];
        foreach ($criterias as $criteria) {
            $sumValue = 0;
            foreach ($alternatives as $alternative) {
                $decisionValue = AlternativeCriteria::where(
                    'alternative_id',
                    $alternative->id
                )
                    ->where('criteria_id', $criteria->id)
                    ->first()->value;

                if ($criteria->category == 'Cost') {
                    $decisionValue = 1 / $decisionValue;
                }
                $sumValue += $decisionValue;
            }
            $sumCriteria[$criteria->id] = $sumValue;
        }

        // 8. Melakukan Tahap Normalisasi dan pembobotan nilai normalisasi
        $normalized = [];
        $weighted = [];
        $optimumValues = []; // membuat array untuk menyimpan nilai fungsi optimalitas alternatif (S)
        foreach ($alternatives as $alternative) {
            // Membuat array untuk menyimpan nilai yang telah dinormalisasi dan dibobot
            $weightedDecisions = [];
            foreach ($criterias as $criteria) {
                $decValue = AlternativeCriteria::where(
                    'alternative_id',
                    $alternative->id
                )
                    ->where('criteria_id', $criteria->id)
                    ->first()->value;
                if ($criteria->category == 'Cost') {
                    $decValue = 1 / $decValue;
                }
                $normValue = $decValue / $sumCriteria[$criteria->id];
                $normalized[$alternative->id][$criteria->id] = $normValue;
                $weightedDecisions[$criteria->id] = $normValue * $criteria->weight;
                $weighted[$alternative->id][$criteria->id] = $weightedDecisions[$criteria->id];
            }
            // memasukan nilai optimum (S) ke dalam array
            $optimumValues[$alternative->id] = array_sum($weightedDecisions);
        }

        // 9. Menghitung tingkatan peringkat tertinggi dari alternatif (K)
        $kValues = [];
        $s0 = $optimumValues[$altzeroId];
        foreach ($alternatives as $alternative) {
            if($alternative->id == $altzeroId) {continue;}
            $kValues[$alternative->name_alternative] = $optimumValues[$alternative->id] / $s0;
        }
        // 10. Menyimpan data hasil perhitungan DSS ke database
        $dss = ListDSS::find($dssId);

        if(!$dss->isCounted){
            $this->storeArasResult($kValues, $dssId);
        }elseif($dss->isCounted){
            $this->updateArasResult($kValues, $dssId);
        }

        $arasResults = ArasResult::where('dss_id', $dssId)->orderBy('score', 'desc')->get();
        $matrixDec = [];
        foreach($alternatives as $alt){
            foreach($criterias as $cri){
                $matrixDec[$alt->id][$cri->id] = AlternativeCriteria::where('alternative_id', $alt->id)->where('criteria_id', $cri->id)->latest()->first()->value;
            }
        }

        return view('dashboard.dss-result',  compact('dss', 'alternatives', 'criterias', 'arasResults', 'normalized', 'weighted', 'optimumValues','kValues', 'matrixDec'));
    }

    public function storeArasResult($kValuesResult, $dssId){
        $listDss = ListDSS::find($dssId);
        foreach($kValuesResult as $alternativeName => $kValue){
            ArasResult::create([
                'dss_id'=> $dssId,
                'name_alternative_res' => $alternativeName,
                'score'=> $kValue
            ]);
        }

        // update nilai isCounted menjadi true
        $listDss->update(['isCounted' => true]);

    }

    public function updateArasResult($kValuesResult, $dssId){
        $arasResults = ArasResult::where('dss_id', $dssId)->delete();
        foreach($kValuesResult as $alternativeName => $kValue){
            ArasResult::create([
                'dss_id'=> $dssId,
                'name_alternative_res' => $alternativeName,
                'score'=> $kValue
            ]);
        }
    }


}
