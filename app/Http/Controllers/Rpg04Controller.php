<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Models\Gdpaper;
use App\Models\Sale_gdpaper;

class Rpg04Controller extends Controller
{
    public function Rpg04(Request $request)
    {
        $first_date = Carbon::now()->firstOfMonth();
        $last_date = Carbon::now()->lastOfMonth();

        // $after_date = Carbon::now()->firstOfMonth();
        // $before_date = Carbon::now()->lastOfMonth();

        $after_date = Carbon::now()->firstOfMonth();
        $before_date = Carbon::now()->lastOfMonth();
        $periods = CarbonPeriod::create($after_date, $before_date);
        
       

        $gdpapers = Gdpaper::where('status','up')->get();

        $gdpaper_datas = Sale_gdpaper::where('created_at','>=',$after_date)->where('created_at','<=',$before_date)->get();

        if($request){
            $after_date = $request->after_date;
            if($after_date){
                $gdpaper_datas = Sale_gdpaper::where('created_at','>=',$after_date)->get();
            }
            $before_date = $request->before_date;
            if($before_date){
                $gdpaper_datas = Sale_gdpaper::where('created_at','<=',$before_date)->get();
            }
            if($after_date && $before_date){
                $gdpaper_datas = Sale_gdpaper::where('created_at','>=',$after_date)->where('created_at','<=',$before_date)->get();
            }
            if($after_date && $before_date){
                $periods = CarbonPeriod::create( $request->after_date,  $request->before_date);
            }
        }

        $datas = [];
        $sums = [];
        foreach($gdpaper_datas as $gdpaper_data){
            $datas[date_format($gdpaper_data->created_at,'Y-m-d')][$gdpaper_data->gdpaper_id] = 0;
        }
        foreach($gdpaper_datas as $gdpaper_data){
            $datas[date_format($gdpaper_data->created_at,'Y-m-d')][$gdpaper_data->gdpaper_id] += $gdpaper_data->gdpaper_total;
        }
        foreach($datas as $data){
            foreach($data as $key=>$da){
                $sums[$key] = 0;
            }
        }
        foreach($datas as $data){
            foreach($data as $key=>$da){
                $sums[$key] += $da;
            }
        }
        $sums['total'] = 0;
        foreach($sums as $sum){
            $sums['total'] += $sum;
        }


        return view('rpg04')->with('request',$request)
                            ->with('first_date',$first_date)
                            ->with('last_date',$last_date)
                            ->with('gdpapers',$gdpapers)
                            ->with('datas',$datas)
                            ->with('periods',$periods)
                            ->with('sums',$sums);
    }
}
