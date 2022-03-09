<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;

class RegisterController extends Controller
{
    //
    public function register(AddUserRequest $request)
    {
        $validated = $request->validated();

        $data = $request->only('name', 'email');
        $data['password'] =  Hash::make($request->password);

        $auth = User::create($data);
        $token = $auth->createToken($auth->name)->plainTextToken;

        $data = ['name' => $auth->name, 'email'=> $auth->email , 'token' => $token];
        return response()->json(['responseCode' => 100, 'responseMessage' => 'Success', 'data' => $data]);
        
    }
}
