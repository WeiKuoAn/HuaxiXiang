<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromA;
use App\Models\PromB;

class PromController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promA_index()
    {
        $promAs = PromA::orderby('status','asc')->paginate(50);
        return view('promA')->with('promAs',$promAs);
    }

    public function promB_index()
    {
        $promBs = PromB::orderby('status','asc')->orderby('seq','asc')->paginate(50);
        return view('promB')->with('promBs',$promBs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promA_create()
    {
        return view('new_promA');
    }

    public function promB_create()
    {
        return view('new_promB');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function promA_store(Request $request)
    {
        $promA = new PromA;
        $promA->name = $request->name;
        $promA->status = $request->status;
        $promA->save();
        return redirect()->route('promA');
    }

    public function promB_store(Request $request)
    {
        $promB = new PromB;
        $promB->name = $request->name;
        $promB->seq = $request->seq;
        $promB->status = $request->status;
        $promB->save();
        return redirect()->route('promB');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promA_show($id)
    {
        $promA = promA::where('id',$id)->first();
        return view('edit_promA')->with('promA',$promA);
    }

    public function promB_show($id)
    {
        $promB = PromB::where('id',$id)->first();
        return view('edit_promB')->with('promB',$promB);
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
    public function promA_update(Request $request, $id)
    {
        $promA = PromA::where('id',$id)->first();
        $promA->name = $request->name;
        $promA->status = $request->status;
        $promA->save();
        return redirect()->route('promA');
    }

    public function promB_update(Request $request, $id)
    {
        $promB = PromB::where('id',$id)->first();
        $promB->name = $request->name;
        $promB->seq = $request->seq;
        $promB->status = $request->status;
        $promB->save();
        return redirect()->route('promB');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
