<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;

class PayController extends Controller
{
    public function index(){
        $datas = Pay::paginate(50);
        return view('pays')->with('datas',$datas);
    }

    public function create(){
        return view('new_pay');
    }

    public function store(Request $request){
        $gdpaper = new Pay();
        $gdpaper->name = $request->name;
        $gdpaper->status = $request->status;
        $gdpaper->save();
        return redirect()->route('pays_suject');
    }

    public function show($id){
        $pay = Pay::where('id',$id)->first();
        return view('edit_pay')->with('pay',$pay);
    }

    public function update($id, Request $request){
        $plan = Pay::where('id',$id)->first();
        $plan->name = $request->name;
        $plan->status = $request->status;
        $plan->save();
        return redirect()->route('pays_suject');
    }
}
