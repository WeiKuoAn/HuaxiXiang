<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayData;
use App\Models\PayItem;
use App\Models\Pay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PayDataController extends Controller
{
    public function index(Request $request)
    {
        $pays = Pay::orderby('seq','asc')->get();
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
            $datas = $datas->orderby('pay_on','desc')->orderby('pay_date','desc')->paginate(50);
            $condition = $request->all();
        }else{
            $datas = PayData::orderby('pay_on','desc')->orderby('pay_date','desc')->paginate(50);
            $sum_pay  = PayData::sum('price');
            $condition = '';
        }
        return view('pay_data.pays_data')->with('datas',$datas)->with('request',$request)->with('pays',$pays)->with('users',$users)->with('condition',$condition)
                                   ->with('sum_pay',$sum_pay);
    }

    public function create(){
        //只取日期當數字
        $today = date('Y-m-d', strtotime(Carbon::now()->locale('zh-tw')));
        $today = explode("-",$today);
        $today = $today[0].$today[1].$today[2];
        //查詢是否當日有無單號
        $data = PayData::orderby('pay_on','desc')->where('pay_on','like',$today.'%')->first();
        // dd(substr($data->pay_on,8,2));

        //單號自動計算
        if(!isset($data->pay_on)){
          $i = 0;
        }else{
            //2023022201
            if(substr($data->pay_on,8,1) != 0){
              $i = intval(substr($data->pay_on,8,2));
            }else{
              $i = intval(str_replace(0, '', substr($data->pay_on,8,2)));
            }
        }

        $i = $i+1;

        if($i <= 9){
            $pay_on = $today.'0'.$i;
          }else{
            $pay_on = $today.$i;
        }

        // dd($pay_on);

        $pays = Pay::where('status','up')->orderby('seq','asc')->get();
        return view('pay_data.new_pay_data')->with('pays',$pays)->with('pay_on',$pay_on);
    }

    public function store(Request $request){
        // dd($request->pay_data_date);

        $PayData = new PayData();
        $PayData->pay_on = $request->pay_on;
        $PayData->pay_date = date('Y-m-d', strtotime(Carbon::now()->locale('zh-tw')));
        $PayData->price = $request->price;
        $PayData->comment = $request->comment;
        $PayData->pay_id = $request->pay_id;
        $PayData->user_id = Auth::user()->id;
        $PayData->save();

        $Pay_data_id = PayData::orderby('id','desc')->first();
        // dd($request->vender_id);
        if(isset($request->pay_data_date)){
            foreach($request->pay_data_date as $key=>$data){
                // dd($request->pay_text[$key]);
                $Pay_Item = new PayItem();
                $Pay_Item->pay_data_id = $Pay_data_id->id;
                $Pay_Item->pay_date = $request->pay_data_date[$key];
                $Pay_Item->invoice_number = $request->pay_invoice_number[$key];
                $Pay_Item->price = $request->pay_price[$key];
                $Pay_Item->invoice_type = $request->pay_invoice_type[$key];
                if(isset($request->vender_id[$key])){
                    $Pay_Item->vender_id = $request->vender_id[$key];
                }else{
                    $Pay_Item->vender_id = null;
                }
                $Pay_Item->comment = $request->pay_text[$key];
                $Pay_Item->save();
            }
        }

        return redirect()->route('new-pay');
    }

    public function show($id){
        $pays_name = Pay::where('status','up')->get();
        $data = PayData::where('id',$id)->first();
        $pays = Pay::where('status','up')->orderby('seq','asc')->get();
        // $pay_items = PayItem::where('pay_data_id',$id)->get();
        // dd(count($pay_items));
        return view('pay_data.edit_pay_data')->with('pays',$pays)
                                             ->with('data',$data)
                                             ->with('pays_name',$pays_name);
    }


    public function update(Request $request,$id){

        // dd($request->pay_data_date);

        $pay = PayData::where('id',$id)->first();
        $pay->pay_on = $request->pay_on;
        $pay->pay_date = $request->pay_date;
        $pay->price = $request->price;
        $pay->pay_id = $request->pay_id;
        $pay->comment = $request->comment;
        $pay->user_id = Auth::user()->id;
        $pay->save();

        $pay_items = PayItem::where('pay_data_id',$id)->get();
        if(count($pay_items) == 0){
                foreach($request->pay_data_date as $key=>$data){
                    $Pay_Item = new PayItem();
                    $Pay_Item->pay_data_id = $id;
                    $Pay_Item->pay_date = $request->pay_data_date[$key];
                    $Pay_Item->invoice_number = $request->pay_invoice_number[$key];
                    $Pay_Item->price = $request->pay_price[$key];
                    $Pay_Item->invoice_type = $request->pay_invoice_type[$key];
                    if(isset($request->vender_id[$key])){
                        $Pay_Item->vender_id = $request->vender_id[$key];
                    }else{
                        $Pay_Item->vender_id = null;
                    }
                    $Pay_Item->comment = $request->pay_text[$key];
                    $Pay_Item->save();
            }
        }elseif(count($pay_items) > 0){
            PayItem::where('pay_data_id', $id)->delete();
            if(isset($request->pay_data_date)){
                foreach($request->pay_data_date as $key=>$data){
                    $Pay_Item = new PayItem();
                    $Pay_Item->pay_data_id = $id;
                    $Pay_Item->pay_date = $request->pay_data_date[$key];
                    $Pay_Item->invoice_number = $request->pay_invoice_number[$key];
                    $Pay_Item->price = $request->pay_price[$key];
                    $Pay_Item->invoice_type = $request->pay_invoice_type[$key];
                    if(isset($request->vender_id[$key])){
                        $Pay_Item->vender_id = $request->vender_id[$key];
                    }else{
                        $Pay_Item->vender_id = null;
                    }
                    $Pay_Item->comment = $request->pay_text[$key];
                    $Pay_Item->save();
                }
            }
        }

        return redirect()->route('pays');
    }


    public function check($id){
        $pay = PayData::where('id',$id)->first();
        return view('pay_data.check_pay_data')->with('pay',$pay);
    }


    public function delshow($id){
        $pays_name = Pay::where('status','up')->get();
        $data = PayData::where('id',$id)->first();
        $pays = Pay::where('status','up')->orderby('seq','asc')->get();
        return view('pay_data.del_pay_data')->with('pays',$pays)
                                   ->with('pays_name',$pays_name)
                                   ->with('data',$data);
    }

    public function delete(Request $request,$id){
        $pay = PayData::where('id',$id)->first();
        $pay->delete();

        $pay_items = PayItem::where('pay_data_id',$id)->get();
        foreach($pay_items as $item){
            $item->delete();
        }
        return redirect()->route('pays');
        
    }
}
