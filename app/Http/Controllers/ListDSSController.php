<?php

namespace App\Http\Controllers;

use App\Models\ArasResult;
use App\Models\ListDSS;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeCriteria;
use Illuminate\Http\Request;

class ListDSSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = ListDSS::all();
        return view('dashboard.home', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('altCount'));
        // validate request

        ListDSS::create(
            $request->validate([
                'dss_title' => 'string',
                // validate numeric type
                'altCount' => 'numeric',
                'critCount' => 'numeric',
            ])
        );

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListDSS  $listDSS
     * @return \Illuminate\Http\Response
     */
    public function show(ListDSS $user)
    {
        $isPrepared = $user->isPrepared;
        $isCounted = $user->isCounted;
        $dssId = $user->id;

        if (!$isPrepared) {
            return view('dashboard.input-params',compact(['dssId', 'isPrepared']));
        } else {
            $dss = ListDSS::find($dssId);
            $alternatives = Alternative::where('dss_id', $dssId)
                ->whereNot('name_alternative', 'alternatif-0')
                ->get();
            $criterias = Criteria::where('dss_id', $dssId)->get();

            if($dss->isCounted){
                // ambil data dari tabel aras_result yang relasi dengan alternative
                $arasResults = ArasResult::where('dss_id', $dssId)->orderBy('score', 'desc')->get();
                $matrixDec = [];
                foreach($alternatives as $alt){
                    foreach($criterias as $cri){
                        $matrixDec[$alt->id][$cri->id] = AlternativeCriteria::where('alternative_id', $alt->id)->where('criteria_id', $cri->id)->first()->value;
                    }
                }
                return view('dashboard.dss-process',  compact('dss', 'alternatives', 'criterias', 'arasResults', 'matrixDec'));
            }

            return view('dashboard.dss-process',  compact('dss', 'alternatives', 'criterias'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListDSS  $listDSS
     * @return \Illuminate\Http\Response
     */
    public function edit(ListDSS $listDSS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListDSS  $listDSS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListDSS $listDSS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListDSS  $listDSS
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListDSS $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
