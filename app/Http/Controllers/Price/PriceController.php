<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;

class PriceController extends Controller
{
   
    public $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function index(Request $req)
    {
        try {
            $params = [
                "date_start" => $req->date_start,
                "date_end" => $req->date_end,
                "ticker" => $req->ticker,
                "currency" => $req->currency
            ];
            $result = low_high_price_model($params);
            return response()->json($result,200);
        } catch (\Throwable $th) {
            die(header("HTTP/1.0 502 BAD_GATEWAY"));
        }
    }

    public function history(Request $req)
    {
        try {
            $conditions_time = [];
            $conditions_ticker = [];
            $select = ["*"];
            if (isset($req->date_start)) {
                $conditions_time[] = [
                    "field_name" => "created_at",
                    "operator" => ">=",
                    "value" => $req->date_start

                ];
                $conditions_time[]=[
                    "field_name" => "created_at",
                    "operator" => "<=",
                    "value" => $req->date_end
                ];
            }
            if (isset($req->ticker)) {
                $conditions_ticker[]=[
                    "field_name" => "ticker",
                    "operator" => "=",
                    "value" => $req->ticker
                ];
            }
            if (isset($req->currency)) {
                if ($req->currency == "usd") {
                    $select=["created_at","usd"];
                }
                if ($req->currency == "idr") {
                    $select=["created_at","idr"];
                }
            }
            $conditions = array_merge($conditions_ticker,$conditions_time);
            $result = std_get([
                "table_name" => "coin_csv",
                "select" => $select,
                "where" => $conditions,
                "order_by" => [
                    "field" => "created_at",
                    "type" => "ASC"
                ]
            ]);
            return response()->json($result,200);
        } catch (\Throwable $th) {
            die(header("HTTP/1.0 502 BAD_GATEWAY"));
        }
    }
}
