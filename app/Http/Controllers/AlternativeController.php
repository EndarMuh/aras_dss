<?php

namespace App\Http\Controllers;

use App\Models\ListDSS;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\AlternativeCriteria;

class AlternativeController extends Controller
{
    public function updateCreateAlt(Request $req)
    {
        $dssId = $req->input('dssId');
        $dss = ListDSS::find($dssId);
        $criterias = Criteria::where('dss_id', $dssId)->get();
        try {
            // Menghapus semua alternatif yang terkait dengan dss_id tertentu
            if ($req->input('alt_id_update')) {
                $name_alternatives = $req->input('name_alternative_update');
                foreach ($req->input('alt_id_update') as $key) {
                    if (Alternative::find($key)) {
                        Alternative::find($key)->update([
                            'name_alternative' => $name_alternatives[$key],
                        ]);
                    }
                }

                if ($req->input('name_alternative_new')) {
                    $name_alternatives = $req->input('name_alternative_new');
                    foreach ($name_alternatives as $key => $value) {
                        Alternative::create([
                            'dss_id' => $dssId,
                            'name_alternative' => $value,
                        ]);

                        if ($dss->isCounted) {
                            $alternative = Alternative::where('dss_id', $dssId)
                            ->orderBy('id', 'desc')
                            ->first()->id;
                            foreach ($criterias as $cri) {
                                AlternativeCriteria::create([
                                    'alternative_id' => $alternative,
                                    'criteria_id' => $cri->id,
                                    'value' => 0,
                                ]);
                            }
                        }
                    }
                }
            }
            return redirect()->route('user.show', $dss);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function removeAlt($altId)
    {
        Alternative::where('id', $altId)->delete();
        return redirect()->back();
    }
}
