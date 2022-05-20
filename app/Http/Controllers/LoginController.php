<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user =  Auth::user();
            $responseArray = [];
            $responseArray['token'] =$user->createToken('myApp')->accessToken;
            $responseArray['name']=$user->name;
            return response()->json($responseArray, 200);
        }else{
            return response()->json(['error'=>'Unautirized', '202']);
        }
    }
    public function users(){
        $list = User::all();
        return $list;
    }
}
