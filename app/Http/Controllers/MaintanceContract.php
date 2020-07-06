<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintanceContract extends Controller
{
    public function show(Request $request,$id = null)
    {
        if($id){
            $details = DB::table('maintance_contract')
                           ->join('customer','maintance_contract.id_customer','=','customer.customer_id')
                           ->join('cabang','maintance_contract.id_cabang','=','cabang.id_cabang')
                           ->join('preventive_maintance','maintance_contract.id_pm','=','preventive_maintance.id_pm')
                           ->join('ganti_parts','maintance_contract.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                           ->where('id_mc','=',$id)
                           ->get();
            if($details){
                return response()->json([
                    'status' => true,
                    'message' => 'details maintance contract!',
                    'data' => $details,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ecoureted!',
                    'data' => null,
                ],500);
            }
        }else{
            $details = DB::table('maintance_contract')
                           ->join('customer','maintance_contract.id_customer','=','customer.customer_id')
                           ->join('cabang','maintance_contract.id_cabang','=','cabang.id_cabang')
                           ->join('preventive_maintance','maintance_contract.id_pm','=','preventive_maintance.id_pm')
                           ->join('ganti_parts','maintance_contract.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                           ->where('status','=','diterima')
                           ->get();
            if($details){
                return response()->json([
                    'status' => true,
                    'message' => 'all maintance contract!',
                    'data' => $details,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ecoureted!',
                    'data' => null,
                ],500);
            }
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id_mc');
        $sts = $request->input('status');
        $update = DB::table('maintance_contract')->where('id_mc','=',$id)->update(['status' => $sts]);
        if($update){
            return response()->json([
                'status' => true,
                'message' => 'updating ststus maintance contract success!',
                'status' => $sts,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ecoureted!',
                'data' => null,
            ],500);
        }
    }

    public function store(Request $request)
    {
        $jlh = $request->input('jumlah_unit');
        $kontak = $request->input('kontak_person');
        $id_customer = $request->input('id_customer');
        $id_cabang = $request->input('id_cabang');
        $id_pm = $request->input('id_pm');
        $id_ganti_parts = $request->input('id_ganti_parts');
        $serialnumber = $request->input('serial_number');
        $sts = $request->input('status');

        $data = [
            'id_customer' => $id_customer,
            'id_cabang' => $id_cabang,
            'id_pm' => $id_pm,
            'jumlah_unit' => $jlh,
            'kontak_person' => $kontak,
            'serial_number' => $serialnumber,
            'id_ganti_parts' => $id_ganti_parts,
            'status' => $request->input('status'),

        ];
        $inserting = DB::table('maintance_contract')->insert($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'data success aded!',
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

    public function showSelesai(Request $request)
    {
        $details = DB::table('maintance_contract')
                           ->join('customer','maintance_contract.id_customer','=','customer.customer_id')
                           ->join('cabang','maintance_contract.id_cabang','=','cabang.id_cabang')
                           ->join('preventive_maintance','maintance_contract.id_pm','=','preventive_maintance.id_pm')
                           ->join('ganti_parts','maintance_contract.id_ganti_parts','=','ganti_parts.id_ganti_parts')
                           ->where('status','=','selesai')
                           ->get();
            if($details){
                return response()->json([
                    'status' => true,
                    'message' => 'all maintance contract selesai!',
                    'data' => $details,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'error ecoureted!',
                    'data' => null,
                ],500);
            }
    }   

    public function updatePhotoMc(Request $request)
    {
        $id = $request->input('id_mc');
        if($request->hasFile('photo')){
            $original_filename = $request->file('photo')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './mc/photo';
            $image = 'mc-' . time() . '.' . $file_ext;
            if($request->file('photo')->move($destination_path, $image)){
                $data = [
                    'photo' => $image,
                ];
                DB::table('maintance_contract')->where('id_mc','=',$id)->update($data);

                return response()->json([
                    'status' => true,
                    'message' => 'data has updated',
                    'data' => $data,
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'server error!',
                    'data' => null,
                ],500);
            }
            
        }
    }

    public function updateFileMc(Request $request)
    {
        if($request->hasFile('files')){
            $original_filename = $request->file('files')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './mc/files';
            $fil = 'cm-' . time() . '.' . $file_ext;
            if($request->file('files')->move($destination_path, $fil)){
                $id = $request->input('id_mc');
                $update = DB::table('maintance_contract')->where('id_mc','=',$id)->update([
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
                        'data' => null,
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
}