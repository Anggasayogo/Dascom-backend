<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function show(Request $request,$id)
    {
        $user = DB::table('user')->select('id','name','email','api_token','role_id')->where('id','=',$id)->first();

        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Data has geted',
                'data' => $user,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data not be found!',
                'data' => null,
            ],404);
        }
    }

    public function showAll()
    {
        $user = DB::table('user')->select('id','name','email','api_token','role_id')->get();

        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Data has geted',
                'data' => $user,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data not be found!',
                'data' => null,
            ],404);
        }
    }
   
}
