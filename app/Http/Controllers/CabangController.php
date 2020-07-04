<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function store(Request $request)
    {
        $namacbng = $request->input('nama_cabang');
        $kodecbng = $request->input('kode_cabang');
        $kanwil = $request->input('kanwil');
        $addres = $request->input('addres');
        $phonenumber = $request->input('phone_number');

        $data = [
            'nama_cabang' => $namacbng,
            'kode_cabang' => $kodecbng,
            'kanwil' => $kanwil,
            'addres' => $addres,
            'phone_number' => $phonenumber,
        ];

        if($data){
            $insering = DB::table('cabang')->insert($data);
            if($insering)
            {
                return response()->json([
                    'status' => true,
                    'message' => 'success added cabang!',
                    'data' => $data
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted!',
                    'data' => null
                ],500);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null
            ],500);
        }
    }

    public function update(Request $request)
    {
        $namacbng = $request->input('nama_cabang');
        $kodecbng = $request->input('kode_cabang');
        $kanwil = $request->input('kanwil');
        $addres = $request->input('addres');
        $phonenumber = $request->input('phone_number');
        $id = $request->input('id_cabang');

        $data = [
            'nama_cabang' => $namacbng,
            'kode_cabang' => $kodecbng,
            'kanwil' => $kanwil,
            'addres' => $addres,
            'phone_number' => $phonenumber,
        ];

        $updated = DB::table('cabang')->where('id_cabang','=',$id)->update($data);
        if($updated)
        {
            return response()->json([
                'status' => true,
                'message' => 'success update cabang!',
                'data' => $data
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null
            ],500);
        }
    }

    public function destroy($id)
    {
        $delete = DB::table('cabang')->where('id_cabang','=',$id)->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'success deleted cabang!',
                'id cabang' => $id
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error id not found!',
                'id cabang' => $id
            ],404);
        }
    }

    public function showdetails(Request $request,$id = null)
    {
        if($id){
            $details = DB::table('cabang')->where('id_cabang','=',$id)->first();
            if($details){
                return response()->json([
                    'status' => true,
                    'message' => 'success get details cabang!',
                    'data' => $details
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocurreted!',
                    'data' => null
                ],500);
            }
        }else{
            $cabangall = DB::table('cabang')->get();
            if($cabangall){
                return response()->json([
                    'status' => true,
                    'message' => 'success get all cabang!',
                    'data' => $cabangall
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocurreted!',
                    'data' => null
                ],500);
            }
        }
    }

}