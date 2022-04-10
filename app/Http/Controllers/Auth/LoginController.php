<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Hash;
use ReallySimpleJWT\Token;

class LoginController extends Controller
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
                'user_email' => 'required|email:rfc,dns',
                'user_password' => 'required|max:255'
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

            $auth_database_checking = std_get([
                "select" => "*",
                "table_name" => "user",
                "where" => [[
                    "field_name" => "user_email",
                    "operator" => "=",
                    "value" => $req->user_email
                ]],
                "first_row" => true
            ]);
            if ($auth_database_checking != []) {
                if ($auth_database_checking["user_is_blocked"] == 1) {
                    return response(502)->json(["message" => "Your account is blocked"]);
                }else{
                    if (Hash::check($req->user_password, $auth_database_checking["user_password"])) {
                        
                        $expiration = time() + 3600;
                        $token = Token::create($auth_database_checking["user_id"],env('JWT_SECRET'), $expiration,"nobi_tester");
                        std_update([
                            "table_name" => "user",
                            "where" => ["user_id" => $auth_database_checking["user_id"]],
                            "data" =>[
                                "api_token" => $token
                            ]
                        ]);
                        return response()->json(["token" => $token],200);
                    }else{
                        if ($auth_database_checking["user_counter_error"] >= 3) {
                            std_update([
                                "table_name" => "user",
                                "where" => ["user_id" => $auth_database_checking["user_id"]],
                                "data" =>[
                                    "user_is_blocked" => 1
                                ]
                            ]);
                        }
                        return response()->json(["message"=>"Too Many Wrong Password, Your account is blocked, Please Contact the admin."],500);
                    }
                }

            }else {
                return response()->json(["message"=>"We didn't found your account, please contact our admin."],404);
            }
            
        } catch (\Throwable $th) {
            die(header("HTTP/1.0 502 BAD_GATEWAY"));
        }
    }

    
}
