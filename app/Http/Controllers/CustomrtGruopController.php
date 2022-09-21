<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustGroup;

class CustomrtGruopController extends Controller
{
    public function index()
    {
        $datas = CustGroup::paginate(50);
        return view('cust_groups')->with('datas',$datas);
    }

    public function create(){
        return view('new_cust_group');
    }

    public function store(Request $request){
        $cust_group = new CustGroup();
        $cust_group->name = $request->name;
        $cust_group->status = $request->status;
        $cust_group->save();
        return redirect()->route('customer.group');
    }

    public function show($id){
        $data = CustGroup::where('id',$id)->first();
        return view('edit_cust_group')->with('data',$data);
    }

    public function update($id, Request $request){
        $cust_group = CustGroup::where('id',$id)->first();
        $cust_group->name = $request->name;
        $cust_group->status = $request->status;
        $cust_group->save();
        return redirect()->route('customer.group');
    }
}
