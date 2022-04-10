<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
   
    public $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function submit_validation($req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'user_email' => 'required|email:rfc,dns|unique:user,user_email',
                'user_password' => 'required|min:5|max:255|alpha_num'
            ], [], [
                'user_email' => 'Email',
                'user_password' => 'Password'
            ]);

            if ($validator->fails()) {
                return $validator->errors()->all();
            }
            return true;
        } catch (\Throwable $error) {
            return false;
        }
    }

    public function index(Request $req)
    {
        try {
            $val_res = $this->submit_validation($req);
            if ($val_res !== true) {
                return $this->response->json($req, 400, "BAD_REQUEST", $val_res);
            }

            $result = std_insert_get_id(
                [
                    "table_name" => "user",
                    "data" => [
                        "user_email" => $req->user_email,
                        "user_password" => Hash::make($req->user_password),
                        "created_at" => date("Y-m-d H:i:s")
                    ]
                ]
            );
            
            if ($result != false) {
                return response()->json([
                    "user_id" => $result,
                    "status" => "Success",
                    'message'=>"Success Registered."
                ],200);
            }else {
                return response()->json([
                    "status" => "Fail",
                    'message' => "Terjadi kesalahan dalam melakukan proses register, silahkan coba berberapa saat lagi."
                ], 500);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Fail",
                'message' => "Terjadi kesalahan dalam melakukan proses register, silahkan coba berberapa saat lagi."
            ], 500);
        }
    }

    
}
