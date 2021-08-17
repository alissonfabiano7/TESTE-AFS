<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GraphController extends Controller
{
    public function index(Request $request)
    {

        $dateSelected = $request->input('date-selected');

        $fundos = DB::table('fundos')->groupBy('id')->get(['id']);

        $fundosArray = [];

        $lastSevenDays =[];

        foreach ($fundos as $fundo)
        {
            $fundosArray[$fundo->id] = array();

            for($i=1; $i<8; $i++)
            {

                $patrimonios = DB::table('patrimonios')->where('fundo_id', '=', $fundo->id)->
                whereDate('date', '>', Carbon::parse($dateSelected)->subDays($i))->
                sum('value');

                array_push($fundosArray[$fundo->id], $patrimonios);
            
            }
    
        }
        for($i=7; $i>0; $i--)
        {
            array_push($lastSevenDays, Carbon::parse($dateSelected)->subDays($i)->toDateString());
        }

        return view('graph', ['fundosArray' => $fundosArray, 'lastSevenDays' => $lastSevenDays]);

    }


}
