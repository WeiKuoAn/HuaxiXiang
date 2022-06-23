<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cash;
use Illuminate\Support\Facades\Auth;


class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $datas = Cash::paginate(50);
            $cash_sums = Cash::sum('price');
            $after_date = $request->after_date;
            if($after_date){
                $datas = Cash::where('cash_date','>=',$after_date)->paginate(50);
                $cash_sums = Cash::where('cash_date','>=',$after_date)->sum('price');
            }
            $before_date = $request->before_date;
            if($before_date){
                $datas = Cash::where('cash_date','<=',$before_date)->paginate(50);
                $cash_sums = Cash::where('cash_date','<=',$before_date)->sum('price');
            }
            if($after_date && $before_date){
                $datas = Cash::where('cash_date','>=',$after_date)->where('cash_date','<=',$before_date)->paginate(50);
                $cash_sums = Cash::where('cash_date','>=',$after_date)->where('cash_date','<=',$before_date)->sum('price');
            }
            $condition = $request->all();
        }else{
            $condition = '';
        }
        
        return view('cashs')->with('request',$request)
                            ->with('datas',$datas)
                            ->with('condition',$condition)
                            ->with('cash_sums',$cash_sums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new_cash_data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cash = new Cash();
        $cash->title = $request->title;
        $cash->cash_date = $request->cash_date;
        $cash->price = $request->price;
        $cash->comment = $request->comment;
        $cash->user_id = Auth::user()->id;
        $cash->save();
        return redirect()->route('cashs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Cash::where('id',$id)->first();
        return view('edit_cash')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Cash::where('id',$id)->first();
        $data->title = $request->title;
        $data->cash_date = $request->cash_date;
        $data->price = $request->price;
        $data->comment = $request->comment;
        $data->user_id = Auth::user()->id;
        $data->save();
        return redirect()->route('cashs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Cash::where('id',$id)->first();
        return view('del_cash')->with('data',$data);
    }

    public function delete($id)
    {
        $data = Cash::where('id',$id)->first();
        $data->delete();
        return redirect()->route('cashs');
    }
}
