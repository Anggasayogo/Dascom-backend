<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceCmController extends Controller
{
    public function showSelesai(Request $request,$id=null)
    {
        if($id){
            $data = DB::table('service_cm')
                        ->join('service_type','service_cm.service_id','=','service_type.service_id')
                        ->join('customer','service_cm.customer_id','=','customer.customer_id')
                        ->join('ganti_parts','service_cm.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                        ->where('id_service_cm','=',$id)
                        ->first();
            if($data){
                return response()->json([
                    'status' => true,
                    'message' => 'data succes geted!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data not found!',
                    'data' => null,
                ],500);
            }            
        }else{
            $data = DB::table('service_cm')
                        ->join('service_type','service_cm.service_id','=','service_type.service_id')
                        ->join('customer','service_cm.customer_id','=','customer.customer_id')
                        ->join('ganti_parts','service_cm.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                        ->where('status','=','selesai')
                        ->first();
            if($data){
                return response()->json([
                    'status' => true,
                    'message' => 'data succes geted!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data fails geted!',
                    'data' => null,
                ],500);
            }               
        }
    }

    public function updatests(Request $request)
    {
        $id = $request->input('id_service_cm');
        $sts = $request->input('status');

        $updated = DB::table('service_cm')->where('id_service_cm','=',$id)->update(['status' => $sts]);
        if($updated){
            return response()->json([
                'status' => true,
                'message' => 'status hass updated!',
                'status' => $sts,
            ],201);       
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
                'status' => null,
            ],500); 
        }
    }

    public function show(Request $request,$id = null)
    {

        if($id){
            $data = DB::table('service_cm')
                        ->join('service_type','service_cm.service_id','=','service_type.service_id')
                        ->join('customer','service_cm.customer_id','=','customer.customer_id')
                        ->join('ganti_parts','service_cm.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                        ->where('id_service_cm','=',$id)
                        ->first();
            if($data){
                return response()->json([
                    'status' => true,
                    'message' => 'data succes geted!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data not found!',
                    'data' => null,
                ],500);
            }            
        }else{
            $data = DB::table('service_cm')
                        ->join('service_type','service_cm.service_id','=','service_type.service_id')
                        ->join('customer','service_cm.customer_id','=','customer.customer_id')
                        ->join('ganti_parts','service_cm.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                        ->where('status','=','diterima')
                        ->first();
            if($data){
                return response()->json([
                    'status' => true,
                    'message' => 'data succes geted!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data fails geted!',
                    'data' => null,
                ],500);
            }               
        }
    }


    public function store(Request $request)
    {
        $data = [
            'no_service_cm' =>$request->input('no_service_cm'),
            'service_id' => $request->input('service_id'),
            'customer_id' => $request->input('customer_id'),
            'tanggal' => $request->input('tanggal'),
            'status' => $request->input('status'),
            'id_ganti_parts' => $request->input('id_ganti_parts'),
            'serial_number' => $request->input('serial_number'),
            'status_unit' => $request->input('status_unit'),
            'keterangan_rusak' => $request->input('keterangan_rusak'),
        ];

        $inserting = DB::table('service_cm')->insert($data);
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

    public function updateServicecm(Request $request)
    {
        $id = $request->input('id_service_cm');
        $keterangan = $request->input('keterangan');
        $updated = DB::table('service_cm')->where('id_service_cm','=',$id)->update(['keterangan' => $keterangan]);
        if($updated){
            return response()->json([
                'status' => true,
                'message' => 'keterangan success updated!',
                'keterangan' => $keterangan,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'keterangan fail updated!',
                'keterangan' => null,
            ],400);
        }
    }

    public function updateServicecmsts(Request $request)
    {
        $id = $request->input('id_service_cm');
        $keterangan = $request->input('status_dan_keterangan');
        $updated = DB::table('service_cm')->where('id_service_cm','=',$id)->update(['status_dan_keterangan' => $keterangan]);
        if($updated){
            return response()->json([
                'status' => true,
                'message' => 'Status keterangan success updated!',
                'Status keterangan' => $keterangan,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Status keterangan fail updated!',
                'Status keterangan' => null,
            ],400);
        }   
    }

    public function updateFile(Request $request)
    {
        if($request->hasFile('files')){
            $original_filename = $request->file('files')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './servicecm/files';
            $fil = 'cm-' . time() . '.' . $file_ext;
            if($request->file('files')->move($destination_path, $fil)){
                $id = $request->input('id_service_cm');
                $update = DB::table('service_cm')->where('id_service_cm','=',$id)->update([
                    'file' => $fil,
                ]);
               if($update){
                    return response()->json([
                        'status' => true,
                        'message' => 'files has updated!',
                        'data' => $fil,
                    ],201);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'error ecoureted!',
                        'data' => $fil,
                    ],500);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'file dosent uploaded!',
                    'data' => null,
                ],400);
            }
        }
    }

    public function updatePhoto(Request $request)
    {
        if($request->hasFile('photo')){
            $original_filename = $request->file('photo')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './servicecm/photo';
            $image = 'cm-' . time() . '.' . $file_ext;
            if($request->file('photo')->move($destination_path, $image)){
                $id = $request->input('id_service_cm');
                $update = DB::table('service_cm')->where('id_service_cm','=',$id)->update([
                    'photo' => $image,
                ]);
                if($update){
                    return response()->json([
                        'status' => true,
                        'message' => 'photo has updated!',
                        'data' => $image,
                    ],201);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'photo dosent uploaded!',
                        'data' => null,
                    ],400);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'photo dosent uploaded!',
                    'data' => null,
                ],400);
            }

        }
    }

}