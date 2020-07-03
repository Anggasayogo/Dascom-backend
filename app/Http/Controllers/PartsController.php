<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartsController extends Controller
{

    public function destroy($id)
    {
        $delete = DB::table('ganti_parts')->where('id_ganti_parts','=',$id)->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'parts deleted!',
                'parts id' => $id,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'parts not found!',
            ],404);
        }
    }

    public function update(Request $request)
    {
        $jenis = $request->input('jenis');
        $description = $request->input('description_parts');
        $id = $request->input('id_ganti_parts');

        $data = [
            'jenis' => $jenis,
            'description_parts' => $description,
        ];

        $updated = DB::table('ganti_parts')->where('id_ganti_parts','=',$id)->update($data);
        if($updated){
            return response()->json([
                'status' => true,
                'message' => 'data success updated!',
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

    public function show(Request $request,$id = null)
    {
        if($id){
            $databyid = DB::table('ganti_parts')->where('id_ganti_parts','=',$id)->first();
            if($databyid){
                return response()->json([
                    'status' => true,
                    'message' => 'data found!',
                    'data' => $databyid,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data not be found!',
                    'data' => null,
                ],404);
            }
        }else{
            $data = DB::table('ganti_parts')->get();
            return response()->json([
                'status' => true,
                'message' => 'data found!',
                'data' => $data,
            ],200);
        }
    }

    public function store(Request $request)
    {
        $jenis = $request->input('jenis');
        $description = $request->input('description_parts');

        $data = [
            'jenis' => $jenis,
            'description_parts' => $description,
        ];

        if($data){
            DB::table('ganti_parts')->insert($data);
            return response()->json([
                'status' => true,
                'message' => 'data succes aded!',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'data is required!',
                'data' => null,
            ],400);
        }
    }

    
}