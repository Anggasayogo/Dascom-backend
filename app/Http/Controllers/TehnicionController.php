<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TehnicionController extends Controller
{
    public function store(Request $request)
    {
        $nama = $request->input('name_staf');
        $position = $request->input('position');
        $addres = $request->input('addres');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $work_area = $request->input('work_area');

        $data = [
            'name_staf' => $nama,
            'position' => $position,
            'addres' => $addres,
            'phone' => $phone,
            'email' => $email,
            'work_area' => $work_area,
        ];

        $inserting = DB::table('staf')->insert($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'data succes aded!',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null,
            ],500);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('staf_id');
        $nama = $request->input('name_staf');
        $position = $request->input('position');
        $addres = $request->input('addres');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $work_area = $request->input('work_area');

        $data = [
            'name_staf' => $nama,
            'position' => $position,
            'addres' => $addres,
            'phone' => $phone,
            'email' => $email,
            'work_area' => $work_area,
        ];

        $inserting = DB::table('staf')->where('id_staf','=',$id)->update($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'data succes updated!',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null,
            ],500);
        }
    }

    public function destroy($id)
    {
        $delete = DB::table('staf')->where('staf_id','=',$id)->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'data succes deleted!',
                'id_staf' => $id,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null,
            ],500);
        }
    }

    public function show(Request $request,$id = null)
    {
        if($id){
            $detail = DB::table('staf')->where('staf_id','=',$id)->first();
            if($detail){
                return response()->json([
                    'status' => true,
                    'message' => 'detail data succes geted!',
                    'data' => $detail,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted!',
                    'data' => null,
                ],500);
            }
        }else{
            $detail = DB::table('staf')->get();
            if($detail){
                return response()->json([
                    'status' => true,
                    'message' => 'data succes geted!',
                    'data' => $detail,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted!',
                    'data' => null,
                ],500);
            }
        }
    }
}