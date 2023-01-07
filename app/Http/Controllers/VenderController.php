<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vender;
use App\Models\Customer;

class VenderController extends Controller
{
    // public function customer(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $output = "";
    //         $custs = Customer::where('name', 'like', $request->cust_name . '%')->get();

    //         if($custs){
    //             foreach ($custs as $key => $cust) {
    //                 $output.=  '<option value="'.$cust->id.'" label="('.$cust->name.')-'.$cust->mobile.'">';
    //               }
    //         }
    //         return Response($output);
    //     }
    // }
    public function index()
    {
        $datas = Vender::paginate(50);
        return view('vender_data.vender')->with('datas', $datas);
    }

    public function create(){
        return view('vender_data.new_vender');
    }

    public function store(Request $request){
        $vender = new Vender();
        $vender->name = $request->name;
        $vender->number = $request->number;
        $vender->status = $request->status;
        $vender->save();
        return redirect()->route('new-vender');
    }

    public function show($id){
        $data = Vender::where('id',$id)->first();
        return view('vender_data.edit_vender')->with('data',$data);
    }

    public function update($id, Request $request){
        $vender = Vender::where('id',$id)->first();
        $vender->name = $request->name;
        $vender->status = $request->status;
        $vender->number = $request->number;
        $vender->save();
        return redirect()->route('vender');
    }

}
