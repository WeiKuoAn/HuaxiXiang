<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','0')->paginate(30);
        return view('users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'entry_date' => $request->entry_date,
            'level' => '2'
        ]);

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('edit_user')->with('user', $user)
                                    ->with('hint', '0');
    }

    public function password_show()
    {
        return view('edit_user_password')->with('hint','0');
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
    public function password_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ((Hash::check($request->password, $user->password))) {
            if ($request->password_new === $request->password_conf) {
                $user->password = Hash::make($request->password_new);
                $user->save();
                return view('auth.login');
            }
        } else {
            return view('edit_user_password')->with(['hint' => '1']);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if(Auth::user()->level == 0){
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->entry_date = $request->entry_date;
            $user->level = $request->level;
            $user->status = $request->status;
            $user->save();
        }else{
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->save();
        }
        return view('edit_user')->with('user', $user)
                                    ->with('hint','1');
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
