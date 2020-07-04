<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function show(Request $request,$id = null)
    {
        if($id){
            $customer = DB::table('customer')->where('customer_id','=',$id)->first();
            if($customer){
                return response()->json([
                    'status' => true,
                    'message' => 'customer has get!',
                    'data' => $customer,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'customer noot be found!',
                    'data' => null,
                ],404);
            }
        }else{
            $data = DB::table('customer')->get();

            return response()->json([
                'status' => true,
                'message' => 'data has geted!',
                'data' => $data,
            ]);
        }
    }

    public function store(Request $request)
    {
        $perusahaan = $request->input('nama_perushaan');
        $nama_customer = $request->input('customer_name');
        $addres = $request->input('addres');
        $email = $request->input('email');
        $phone = $request->input('phone');
        

        if($request->hasFile('logo')){
            $original_filename = $request->file('logo')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './logo';
            $image = 'logo-' . time() . '.' . $file_ext;
            if($request->file('logo')->move($destination_path, $image)){
                $data = [
                    'nama_perusahaan' => $perusahaan,
                    'customer_name' => $nama_customer,
                    'addres' => $addres,
                    'email' => $email,
                    'phone' => $phone,
                    'logo' => $image,
                ];
                
                DB::table('customer')->insert($data);

                return response()->json([
                    'status' => true,
                    'message' => 'data has created',
                    'data' => $data,
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'server error!',
                    'data' => null,
                ],500);
            }
            
        }else{
            return response()->json([
                'status' => false,
                'message' => 'add data fail!',
                'data' => null,
            ],400);
        }
    }


    public function update(Request $request)
    {
        $perusahaan = $request->input('nama_perushaan');
        $nama_customer = $request->input('customer_name');
        $addres = $request->input('addres');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $id = $request->input('id');

        if($request->hasFile('logo')){
            $original_filename = $request->file('logo')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './logo';
            $image = 'logo-' . time() . '.' . $file_ext;
            if($request->file('logo')->move($destination_path, $image)){
                $data = [
                    'nama_perusahaan' => $perusahaan,
                    'customer_name' => $nama_customer,
                    'addres' => $addres,
                    'email' => $email,
                    'phone' => $phone,
                    'logo' => $image,
                ];
                DB::table('customer')->where('customer_id','=',$id)->update($data);

                return response()->json([
                    'status' => true,
                    'message' => 'data has created',
                    'data' => $data,
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'server error!',
                    'data' => null,
                ],500);
            }
            
        }else{
            $data = [
                'nama_perusahaan' => $perusahaan,
                'customer_name' => $nama_customer,
                'addres' => $addres,
                'email' => $email,
                'phone' => $phone,
            ];
            DB::table('customer')->where('customer_id','=',$id)->update($data);
            return response()->json([
                'status' => true,
                'message' => 'data has update no image !',
                'data' => $data,
            ],201);
        }

    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('customer')->where('customer_id','=',$id)->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'customer deleted!',
                'customer id' => $id,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'customer not found!',
            ],404);
        }
    }   

}
