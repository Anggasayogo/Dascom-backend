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
        $perusahaan = $request->input('nama_perusahaan');
        $nama_customer = $request->input('customer_name');
        $addres = $request->input('addres');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $image = $request->input('logo');
        
        $data = [
            'nama_perusahaan' => $perusahaan,
            'customer_name' => $nama_customer,
            'addres' => $addres,
            'email' => $email,
            'phone' => $phone,
            'logo' => $image,
        ];

        $inserting = DB::table('customer')->insert($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'customer aded!',
                'data' => $data,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
            ],500);
        }
    }


    public function update(Request $request,$id)
    {
        $perusahaan = $request->input('nama_perusahaan');
        $nama_customer = $request->input('customer_name');
        $addres = $request->input('addres');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $image = $request->input('logo');
        
        $data = [
            'nama_perusahaan' => $perusahaan,
            'customer_name' => $nama_customer,
            'addres' => $addres,
            'email' => $email,
            'phone' => $phone,
            'logo' => $image,
        ];

        $inserting = DB::table('customer')->where('customer_id','=',$id)->update($data);
        if($inserting){
            return response()->json([
                'status' => true,
                'message' => 'customer updated!',
                'data' => $data,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error ocureted!',
            ],500);
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
