<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Rpg03Controller extends Controller
{
    public function rpg03(Request $request)
    {
        return view('rpg03')->with('request',$request);
    }
}
