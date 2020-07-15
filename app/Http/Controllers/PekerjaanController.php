<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;

class PekerjaanController extends Controller
{

    public function pekerjaanselesai()
    {
        $data = DB::table('pekerjaan')
                        ->join('customer','pekerjaan.id_customer','=','customer.customer_id')
                        ->join('service_type','pekerjaan.service_id','=','service_type.service_id')
                        ->where('status','=','selesai')
                        ->get();
            if($data){
                return response()->json([
                    'status' => true,
                    'message' => 'detail pekerjaan selesai!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted',
                    'data' => null,
                ],500);
            }  
    }

    public function show(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('pekerjaan')
                        ->join('customer','pekerjaan.id_customer','=','customer.customer_id')
                        ->join('service_type','pekerjaan.service_id','=','service_type.service_id')
                        ->where('id_pekerjaan','=',$id)
                        ->get();
            return response()->json([
                'status' => true,
                'message' => 'data found!',
                'data' => $data,
            ],200);
        }else{
            $data = DB::table('pekerjaan')
                        ->join('customer','pekerjaan.id_customer','=','customer.customer_id')
                        ->join('service_type','pekerjaan.service_id','=','service_type.service_id')
                        ->where('status','=','diterima')
                        ->get();
            if($data !== []){
                return response()->json([
                    'status' => true,
                    'message' => 'data found!',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'data not be found!',
                    'data' => null,
                ],404);
            }
        }
    }

    public function updatepekerjaan(Request $request)
    {
        $ket = $request->input('keterangan');
        $id = $request->input('id_pekerjaan');
        $update = DB::table('pekerjaan')->where('id_pekerjaan','=',$id)->update(['keterangan' => $ket]);
        if($update){
            return response()->json([
                'status' => true,
                'message' => 'keterangan success update',
                'data' => $ket
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'id pekerjaan not found!',
                'data' =>null
            ],404);
        }

    }

    public function updatefilepekerjaan(Request $request)
    {
        if($request->hasFile('files')){
            $original_filename = $request->file('files')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './pekerjaan/files';
            $fil = 'photo-' . time() . '.' . $file_ext;
            if($request->file('files')->move($destination_path, $fil)){
                $id = $request->input('id_pekerjaan');
                $update = DB::table('pekerjaan')->where('id_pekerjaan','=',$id)->update([
                    'file' => $fil,
                ]);
               if($update){
                    return response()->json([
                        'status' => true,
                        'message' => 'files pekerjaan has updated created!',
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

    public function updtselesaikerja(Request $request)
    {
        $sts = $request->input('status');
        if($sts){
            $id = $request->input('id_pekerjaan');
            $update = DB::table('pekerjaan')->where('id_pekerjaan','=',$id)->update([
                'status' => $sts,
            ]);

            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'ststus has updated!',
                    'status' => $sts,
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ocureted!',
                    'status' => null,
                ],500);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'ststus is required!',
                'status' => null,
            ],400);
        }
    }


    public function store(Request $request)
    {
        $id_customer = $request->input('id_customer');
        $status = $request->input('status');
        $nokerja = $request->input('no');
        $service_id = $request->input('service_id');
        $data = [
            'id_customer' => $id_customer,
            'status' => $status,
            'no' => $nokerja,
            'service_id' => $service_id,
        ];
        $inserting = DB::table('pekerjaan')->insert($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'data has created!',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'data fails!',
                'data' => null,
            ],400);
        }
        
    }

    public function updatephotoepekerjaan(Request $request)
    {
        if($request->hasFile('photo')){
            $original_filename = $request->file('photo')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './pekerjaan/photo';
            $image = 'photo-' . time() . '.' . $file_ext;
            if($request->file('photo')->move($destination_path, $image)){
                $id = $request->input('id_pekerjaan');
                $update = DB::table('pekerjaan')->where('id_pekerjaan','=',$id)->update([
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

    public function updtserialnum(Request $request)
    {
        $id = $request->input('id_pekerjaan');
        $serialnum = $request->input('serial_number');

        $update = DB::table('pekerjaan')->where('id_pekerjaan','=',$id)->update(['serial_number' => $serialnum]);
        if($update){
            return response()->json([
                'status' => true,
                'message' => 'serialnumber has updated!',
                'data' => $serialnum,
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'serial dosent updated!',
                'data' => null,
            ],400);
        }

    }
}
