<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            "name"=>"required|string|max:191",
            "email"=>"required|string|max:191|unique:users,email",
            "password"=>"required|string"
        ]);

        $user = User::create([
            "name"=>$data['name'],
            "email"=>$data['email'],
            "password"=>Hash::make($data['password']), 
        ]);

        $token = $user->createToken('crudapi')->plainTextToken;

        $response = [
            "user"=>$user,
            "token" => $token
        ];

        return response($response, 201);

    }

    public function login(Request $request){
        $data = $request->validate([
            "email"=>"required|string",
            "password"=>"required|string"
        ]);

        $user = User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password))
        {
            return response(["message"=>"invalid credentials"], 401);
        }else{
            $token = $user->createToken('crudapi')->plainTextToken;
            $response = [
                "user"=>$user,
                "token"=>$token
            ];

            return response($response, 200);
        }
    }

    public function logout(){
        // $user->tokens()->delete();

        auth()->user()->tokens()->delete();

        return response(['message'=>'Logged out successfully']);
    }
}
