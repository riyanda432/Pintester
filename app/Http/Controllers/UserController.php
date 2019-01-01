<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function store (Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:200',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|min:8',
             'gender' => 'required',
         ]);
 
         if($validator->fails()) {
             return back()->withErrors($validator);
         }

        $user= new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);
        $user->gender = $request->gender;
        $user->image = $request->except('image');
        $user['image'] = time().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->move('img/',
            $user['image']);

        $user->save(); 

        Auth::login($user);

        return redirect('/');
    }
    public function edit (){
        return view ('user/edit');
    }
    public function show(){
        $user = User::all();
        return view ('user/show',compact('user'));
    }
    public function update(Request $request,$id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
       
        $user->save(); 

        Auth::login($user);

        return redirect('/');
    }
    public function destroy($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
