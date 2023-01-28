<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debit;
use Illuminate\Support\Facades\Auth;

class DebitController extends Controller
{
    //管理員
    public function index(Request $request)
    {
        
        $state = $request->state;
        if($state != "null"){
            $datas = Debit::where('state',$state);
        }else{
            $datas = Debit::where('state','<=',7);
        }
        $after_date = $request->after_date;
        if($after_date){
            $datas->where('created_at','>=',$after_date);
        }
        $before_date = $request->before_date;
        if($before_date){
            $datas->where('created_at','<=',$before_date);
        }
        $type = $request->type;
        if($type != "null"){
            $datas->where('type',$type);
        }else{
            $datas = $datas;
        }

        $datas = $datas->paginate(50);
        return view('debit.debits')->with('datas',$datas)->with('request',$request);
    }

    public function show($id)
    {
        $data = Debit::where('id',$id)->first();
        return view('debit.edit_debit')->with('data',$data);
    }

    public function update(Request $request,$id)
    {
        $data = Debit::where('id',$id)->first();
        if($request->btn_submit == 'no_agree')
        {
            //不同意
            $data->state = 8;
            $data->admin_comment = $request->admin_comment;
            $data->save();
        }else{
            // dd($request->admin_comment);
            //同意
            $data->state = 9;
            $data->admin_comment = $request->admin_comment;
            $data->save();
        }
        return redirect()->route('debit');
    }

   
}