<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistationController extends Controller
{
    public function index(){
        return view('ragister');
    }
    public function register(){
        $validate = request()->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required'
        ]);
       $input = request()->all();
        $input['password'] = Hash::make(request('password'));
        // request()->all($password);
      $user =  User::create($input);
        $responseArray = [];
        $responseArray['token'] =$user->createToken('myApp')->accessToken;
        $responseArray['name']=$user->name;
        return response()->json($responseArray, 200);
    }

}
