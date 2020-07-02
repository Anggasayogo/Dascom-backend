<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $serviceName = $request->input('nama_service');
        $description = $request->input('description');

        $validasi = $this->validate($request,[
            'nama_service' => 'required',
            'description' => 'required',
        ]);

        if($validasi){

            $data = [
                'nama_service' => $serviceName,
                'description' => $description,
            ];
            DB::table('service_type')->insert($data);
            return response()->json([
                'status' => true,
                'message' => 'data has created!',
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

    public function show(Request $request,$id = null)
    {
        if($id){
            $service = DB::table('service_type')->where('service_id','=',$id)->first();
            if($service){
                return response()->json([
                    'status' => true,
                    'message' => 'showing details service success!',
                    'data' => $service,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'service data not be found!',
                    'data' => null,
                ],404);
            }
        }else{
            $service = DB::table('service_type')->get();
            return response()->json([
                'status' => true,
                'message' => 'showing service success!',
                'data' => $service,
            ]);
        }
    }

    public function update(Request $request)
    {
        $serviceName = $request->input('nama_service');
        $description = $request->input('description');
        $id = $request->input('service_id');
        $data = [
            'nama_service' => $serviceName,
            'description' => $description,
        ];
        $updateservice = DB::table('service_type')->where('service_id','=',$id)->update($data);

        if($updateservice){
            return response()->json([
                'status' => true,
                'message' => 'update service success!',
                'data' => $data,
            ]);
        }
    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('service_type')->where('service_id','=',$id)->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'service deleted!',
                'service_id' => $id,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'service id not found!',
            ],404);
        }
    }
}