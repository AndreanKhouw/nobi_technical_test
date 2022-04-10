<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
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
                'trx_id' => 'required',
                'amount' => 'required',
                'user_id' => 'required'
            ], [], [
                'trx_id' => 'trx id',
                'amount' => 'amount',
                'user_id' => 'user id'
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
            if ($req->ammount == 0.00000001) {
                return response()->json(["message" => "Amount hanya 0.00000001, Silahkan dicoba lagi"],500);
            }
            $user_balance_data = std_get([
                "select" => "*",
                "table_name" => "transaction",
                "where" => [[
                    "field_name" => "user_id",
                    "operator" => "=",
                    "value" => $req->user_id
                ]],
                "first_row" => true
            ]);
            if (!isset($user_balance_data) && $user_balance_data == null) {
                return response()->json(
                    [
                        "trx_id" => $req->trx_id,
                        "amount" => $req->amount,
                        "message" => "This user does not have balance."
                    ],500
                );
            }else {
                if ($req->amount > $user_balance_data) {
                    return response()->json(
                        [
                            "trx_id" => $req->trx_id,
                            "amount" => $req->amount,
                            "message" => "Balance insufficient."
                        ],500
                    );
                }else{
                    $result = transaction_model(["trx_id" => $req->trx_id,
                    "amount" => $req->amount,"user_id" => $req->user_id]);
                    if ($result != false) {
                        return response()->json($result);
                    }else {    
                        return response()->json(["message" => "Terjadi kesalahan pada server, silahkan di coba lagi beberapa saat lagi."],500);
                    }
                }
            }
        } catch (\Throwable $th) {
            die(header("HTTP/1.0 502 BAD_GATEWAY"));
        }
    }

    
}
