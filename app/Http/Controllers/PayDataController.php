<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayData;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PayDataController extends Controller
{
    public function index(Request $request){
        $pays = Pay::get();
        $users = User::get();
        if($request){
            $datas = PayData::where('status', 1);
            $sum_pay = PayData::where('status', 1);
            $after_date = $request->after_date;
            if ($after_date) {
                $datas =  $datas->where('pay_date', '>=', $after_date);
                $sum_pay  = $sum_pay->where('pay_date', '>=', $after_date);
            }
            $before_date = $request->before_date;
            if ($before_date) {
                $datas =  $datas->where('pay_date', '<=', $before_date);
                $sum_pay  = $sum_pay->where('pay_date', '<=', $before_date);
            }
            if($after_date && $before_date){
                $datas =  $datas->where('pay_date', '>=', $after_date)->where('pay_date', '<=', $before_date);
                $sum_pay  = $sum_pay->where('pay_date', '>=', $after_date)->where('pay_date', '<=', $before_date);
            }
            $pay = $request->pay;
            if ($pay != "null") {
                if (isset($pay)) {
                    $datas =  $datas->where('pay_id', $pay);
                    $sum_pay  = $sum_pay->where('pay_id', $pay);
                } else {
                    $datas = $datas;
                    $sum_pay  = $sum_pay;
                }
            }
            $user = $request->user;
            if ($user != "null") {
                if (isset($user)) {
                    $datas =  $datas->where('user_id', $user);
                    $sum_pay  = $sum_pay->where('user_id', $user);
                } else {
                    $datas = $datas;
                    $sum_pay  = $sum_pay;
                }
            }
            $sum_pay  = $sum_pay->sum('price');
            $datas = $datas->orderby('pay_date','desc')->paginate(50);
            $condition = $request->all();
        }else{
            $datas = PayData::orderby('pay_date','desc')->paginate(50);
            $sum_pay  = PayData::sum('price');
            $condition = '';
        }
        return view('pays_data')->with('datas',$datas)->with('request',$request)->with('pays',$pays)->with('users',$users)->with('condition',$condition)
                                   ->with('sum_pay',$sum_pay);
    }
    public function create(){
        $pays = Pay::where('status','up')->get();
        return view('new_pay_data')->with('pays',$pays);
    }

    public function store(Request $request){
        $PayData = new PayData();
        $PayData->pay_date = $request->pay_date;
        $PayData->price = $request->price;
        $PayData->comment = $request->comment;
        $PayData->pay_id = $request->pay_id;
        $PayData->user_id = Auth::user()->id;
        $PayData->save();
        return redirect()->route('pays');
    }

    public function show($id){
        $pays_name = Pay::where('status','up')->get();
        $pay = PayData::where('id',$id)->first();
        return view('edit_pay_data')->with('pay',$pay)
                                       ->with('pays_name',$pays_name);
    }

    public function update(Request $request,$id){
        $pay = PayData::where('id',$id)->first();
        $pay->pay_date = $request->pay_date;
        $pay->price = $request->price;
        $pay->pay_id = $request->pay_id;
        $pay->comment = $request->comment;
        $pay->user_id = Auth::user()->id;
        $pay->save();
        return redirect()->route('pays');
    }

    public function delshow($id){
        $pays_name = Pay::where('status','up')->get();
        $pay = PayData::where('id',$id)->first();
        return view('del_pay_data')->with('pay',$pay)
                                   ->with('pays_name',$pays_name);
    }

    public function delete(Request $request,$id){
        $pay = PayData::where('id',$id)->first();
        $pay->delete();
        return redirect()->route('pays');
        
    }
}
