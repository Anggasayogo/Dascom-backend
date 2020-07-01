<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login(Request $request)
   {
       $email = $request->input('email');
       $password = $request->input('password');

       $user = DB::table('user')->select('id','name','email','password')->where('email','=',$email)->first();
       if(Hash::check($password,$user->password)){
           $api_token = base64_encode(\Illuminate\Support\Str::random(42));
           DB::table('user')->where('email','=',$email)->update(['api_token' => $api_token]);
           return response()->json([
               'status' => true,
               'message' => 'login success!',
               'data' => [
                   'user' => $user,
                   'api_token' => $api_token,
               ],
            ],201);
       }else{
           return response()->json([
               'status' => false,
               'message' => 'login fails!',
               'data' => '',
           ],400);
       }
   }

   public function register(Request $request)
   {
       $name = $request->input('name');
       $email = $request->input('email');
       $password = Hash::make($request->input('password'));

       $register = DB::table('user')->insert([
           'name' => $name,
           'email' => $email,
           'password' => $password,
           'role_id' => 1,
       ]);

       if($register){
           return response()->json([
               'status' => true,
               'message' => 'Register succes!',
           ],201);
       }else{
            return response()->json([
                'status' => false,
                'message' => 'Register fail!',
            ],400);
       }

   }


}
