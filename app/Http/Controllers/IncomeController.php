<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    /*科目新增 */
    public function suject_index(){
        $datas = Income::orderby('status','asc')->orderby('seq','asc')->paginate(50);
        return view('incomes')->with('datas',$datas);
    }

    public function suject_create(){
        return view('new_income');
    }

    public function suject_store(Request $request){
        $data = new Income();
        $data->name = $request->name;
        $data->seq = $request->seq;
        $data->status = $request->status;
        $data->save();
        return redirect()->route('incomes_suject');
    }

    public function suject_show($id){
        $income = Income::where('id',$id)->first();
        return view('edit_income')->with('income',$income);
    }

    public function suject_update($id, Request $request){
        $data = Income::where('id',$id)->first();
        $data->name = $request->name;
        $data->seq = $request->seq;
        $data->status = $request->status;
        $data->save();
        return redirect()->route('incomes_suject');
    }
}
