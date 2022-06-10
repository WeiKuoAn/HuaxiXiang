<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    /*科目新增 */
    public function suject_index(){
        $datas = Income::paginate(50);
        return view('incomes')->with('datas',$datas);
    }

    public function suject_create(){
        return view('new_income');
    }

    public function suject_store(Request $request){
        $gdpaper = new Income();
        $gdpaper->name = $request->name;
        $gdpaper->status = $request->status;
        $gdpaper->save();
        return redirect()->route('incomes_suject');
    }

    public function suject_show($id){
        $income = Income::where('id',$id)->first();
        return view('edit_income')->with('income',$income);
    }

    public function suject_update($id, Request $request){
        $plan = Income::where('id',$id)->first();
        $plan->name = $request->name;
        $plan->status = $request->status;
        $plan->save();
        return redirect()->route('incomes_suject');
    }
}
