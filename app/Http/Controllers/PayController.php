<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;

class PayController extends Controller
{
    public function index(){
        $datas = Pay::orderby('status','asc')->orderby('seq','desc')->paginate(50);
        return view('pays')->with('datas',$datas);
    }

    public function create(){
        return view('new_pay');
    }

    public function store(Request $request){
        $pay = new Pay();
        $pay->name = $request->name;
        $pay->seq = $request->seq;
        $pay->status = $request->status;
        $pay->save();
        return redirect()->route('pays_suject');
    }

    public function show($id){
        $pay = Pay::where('id',$id)->first();
        return view('edit_pay')->with('pay',$pay);
    }

    public function update($id, Request $request){
        $pay = Pay::where('id',$id)->first();
        $pay->name = $request->name;
        $pay->seq = $request->seq;
        $pay->status = $request->status;
        $pay->save();
        return redirect()->route('pays_suject');
    }
}
