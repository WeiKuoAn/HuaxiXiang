<?php

namespace App\Http\Controllers;

use App\Models\SaleSource;
use Illuminate\Http\Request;

class SaleSourceController extends Controller
{
    public function index(){
        $datas = SaleSource::paginate(50);
        return view('source')->with('datas',$datas);
    }

    public function create(){
        return view('new_source');
    }

    public function store(Request $request){
        $source = new SaleSource();
        $source->name = $request->name;
        $source->code = $request->code;
        $source->status = $request->status;
        $source->save();
        return redirect()->route('source');
    }

    public function show($id){
        $source = SaleSource::where('id',$id)->first();
        return view('edit_source')->with('source',$source);
    }

    public function update($id, Request $request){
        $source = SaleSource::where('id',$id)->first();
        $source->name = $request->name;
        $source->code = $request->code;
        $source->status = $request->status;
        $source->save();
        return redirect()->route('source');
    }
}
