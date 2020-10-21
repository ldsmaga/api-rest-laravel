<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected  $rules = [
        'email' => 'required|email|unique:users,email',
        'name' => 'required',
        'password' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('user', Auth::user()->id)->get();
        return response()->json(['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['response' => $validator->messages()], 400);
        }

       $request->merge([
           'birthday'=> $request->birthday,
           'password' => bcrypt($request->password),
       ]);
       
       $userData = $request->all();

       $user = User::create($userData);
 
       return response()->json(['response' => $user], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request)
    {

        $user = User::find(Auth::user()->id);

        if (Auth::user()->id != $user->id) {
            return response()->json(['response' => 'Erro'], 400);
        }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->birthday = $request->birthday;
            $user->password = bcrypt($request->password);

            $user->save();
            
            return response()->json(['response' => $user], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    { 
        $product = User::where('id', Auth::user()->id)->first();
        
            if (Auth::user()->id == $product->id) {
                User::destroy(Auth::user()->id);
                return response()->json(['response' => "Register deleted"], 200);
            } 
            return response()->json(['response' => 'Register not found'], 400);
        
    }
}
