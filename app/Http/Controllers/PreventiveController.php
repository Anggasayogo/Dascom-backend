<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreventiveController extends Controller
{
    public function show(Request $request,$id = null)
    {
        if($id)
        {
            $pm = DB::table('preventive_maintance')->where('id_pm','=',$id)->first();
            if($pm){
                return response()->json([
                    'status' => true,
                    'message' => 'detail preventive has geted!',
                    'data' => $pm,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted!',
                    'data' => null,
                ],500);
            }
        }else{
            $pm = DB::table('preventive_maintance')->get();
            if($pm){
                return response()->json([
                    'status' => true,
                    'message' => 'all preventive has geted!',
                    'data' => $pm,
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

    public function store(Request $request)
    {
        $pm = $request->input('name_pm');
        $inserting = DB::table('preventive_maintance')->insert(['name_pm' => $pm]);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'preventive has aded!',
                'data' => $pm,
            ],200);
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
        $id = $request->input('id_pm');
        $pm = $request->input('name_pm');
        $updating = DB::table('preventive_maintance')->where('id_pm','=',$id)->update(['name_pm' => $pm]);
        if($updating)
        {
            return response()->json([
                'status' => true,
                'message' => 'preventive has updated!',
                'data' => $pm,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'data' => null,
            ],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('preventive_maintance')->where('id_pm','=',$id)->delete();
        if($delete)
        {
            return response()->json([
                'status' => true,
                'message' => 'preventive has deleted!',
                'preventive id' => $id,
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