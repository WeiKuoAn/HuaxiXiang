<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Plan;


class Rpg01Controller extends Controller
{
    public function rpg01(Request $request)
    {
        // $now = Carbon::now()->locale('zh-tw');
        $years = range(Carbon::now()->year, 2022);
        if (isset($request)) {
            $search_year = $request->year;
            $search_month = $request->month;
            $firstDay = Carbon::createFromDate($search_year , $search_month)->firstOfMonth();
            $lastDay = Carbon::createFromDate($search_year , $search_month)->lastOfMonth();
        } else {
            $firstDay = Carbon::now()->firstOfMonth();
            $lastDay = Carbon::now()->lastOfMonth();
        }
        $periods = CarbonPeriod::create($firstDay, $lastDay);
        $plans = Plan::where('status', 'up')->orderby('id')->get();
        foreach ($periods as $period) {
            foreach ($plans as $plan) {
                $datas[$period->format("Y-m-d")][$plan->id]['name'] = $plan->name;
                $datas[$period->format("Y-m-d")][$plan->id]['count'] = 0;
                $sums[$plan->id]['count'] = 0;
                $sums[$plan->id]['count'] += $datas[$period->format("Y-m-d")][$plan->id]['count'];
            }
            $sales = Sale::where('sale_date', $period->format("Y-m-d"))->whereIn('pay_id', ['A', 'B', 'C'])->get();
            foreach ($sales as $sale) {
                if (isset($sale->plan_id)) {
                    $datas[$period->format("Y-m-d")][$sale->plan_id]['count']++;
                }
            }
        }
        // dd($datas);

        foreach ($periods as $period) {
            foreach ($plans as $plan) {
                $sums[$plan->id]['count'] += $datas[$period->format("Y-m-d")][$plan->id]['count'];
            }
        }


        // dd($sums);

        return view('rpg01')->with('datas', $datas)
            ->with('sums', $sums)
            ->with('plans', $plans)
            ->with('years', $years)
            ->with('request', $request);
    }
}
