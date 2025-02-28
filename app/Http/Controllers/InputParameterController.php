<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\ListDSS;
use Illuminate\Http\Request;


class InputParameterController extends Controller
{
    public function storeParameters(Request $request){

        // dss_id
        $dss_id = request()->input('dssId');
        // dd($dss_id);

        // alternatives
        $dss_title = request()->input('name_alternative');

        // criterias
        $name_criteria = request()->input('name_criteria');
        $weight = request()->input('weight');
        $category = request()->input('category');

        try {
            // input alternatives
            foreach ($dss_title as $key) {
                Alternative::create([
                    'dss_id'=>$dss_id,
                    'name_alternative' => $key,
                ]);
            }

            // input criterias
            foreach ($name_criteria as $key => $value) {
                Criteria::create([
                    'dss_id'=> $dss_id,
                    'name_criteria' => $value,
                    'weight' => $weight[$key],
                    'category' => $category[$key]
                ]);
            }

            // update status isPrepared to true (1)
            ListDSS::where('id', $dss_id)->update(['isPrepared' => 1]);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('error', $th->getMessage());
        }
        return redirect()->route('user.process', $dss_id);
    }

    public function runToProcess($dssId){
        $dss = ListDSS::find($dssId);
        $alternatives = Alternative::where('dss_id', $dssId)->whereNot('name_alternative', 'alternatif-0')->get();
        $criterias = Criteria::where('dss_id', $dssId)->get();
        return view('dashboard.dss-process', compact('dss', 'alternatives','criterias'));
    }

}
