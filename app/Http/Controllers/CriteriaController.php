<?php

namespace App\Http\Controllers;

use App\Models\ListDSS;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\AlternativeCriteria;

class CriteriaController extends Controller
{
    public function updateCreateCri(Request $req){
        // criterias
        $dssId = $req->input('dssId');
        $dss = ListDSS::find($dssId);

        try {
            if ($req->input('cri_id_update')) {
                $name_criterias = request()->input('name_criteria_update');
                $weights = request()->input('weight_update');
                $categorys = request()->input('category_update');

                foreach ($req->input('cri_id_update') as $key) {
                    if (Criteria::find($key)) {
                        Criteria::find($key)->update([
                            'name_criteria' => $name_criterias[$key],
                            'weight' => $weights[$key],
                            'category' => $categorys[$key],
                        ]);
                    }
                }

                if ($req->input('name_criteria_new')) {
                    $name_criterias = request()->input('name_criteria_new');
                    $weights = request()->input('weight_new');
                    $categorys = request()->input('category_new');
                    foreach ($name_criterias as $key => $value) {
                        Criteria::create([
                            'dss_id' => $dssId,
                            'name_criteria' => $value,
                            'weight'=> $weights[$key],
                            'category'=> $categorys[$key],
                        ]);

                        if ($dss->isCounted) {
                            $alternatives = Alternative::where('dss_id', $dssId)->get();
                            $cri = Criteria::where('dss_id', $dssId)->orderBy('id', 'desc')->first()->id;
                            foreach ($alternatives as $alt) {
                                AlternativeCriteria::create([
                                    'alternative_id' => $alt->id,
                                    'criteria_id' => $cri,
                                    'value' => 0,
                                ]);
                            }
                        }
                    }
                }
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function removeCri($criId){
        Criteria::where('id', $criId)->delete();
        return redirect()->back();
    }
}
