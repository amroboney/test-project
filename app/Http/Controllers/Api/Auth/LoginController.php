<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(Request $request )
    {
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){ 
            $auth = Auth::user();
            $token = $auth->createToken($auth->name)->plainTextToken;

            $data = ['name' => $auth->name, 'email'=> $auth->email , 'token' => $token];
            return response()->json(['responseCode' => 100, 'responseMessage' => 'Success', 'data' => $data]);

        }
        return response()->json(['responseCode' => 101, 'responseMessage' => 'Data inconrrect']);
    }
}
