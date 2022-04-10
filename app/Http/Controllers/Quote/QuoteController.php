<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;

class QuoteController extends Controller
{
   
    public $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function index(Request $req)
    {
        try {
            $base_url = "https://api.chucknorris.io/jokes/";
            $param = null;
            if (isset($req->search_value) && $req->search_value != null) {
                if ($req->is_category != null && isset($req->is_category) && $req->is_category == 1) {
                    $category_list = curl_get("https://api.chucknorris.io/jokes/categories");
                    $check_category = array_search($req->search_value ,$category_list);
                    if ($check_category != false) {
                        $base_url = $base_url."random";
                        $param = [
                            "category" => $req->search_value
                        ];
                    }else {
                        $base_url = $base_url."search";
                        $param = [
                            "query" => $req->search_value
                        ];
                    }
                }else {
                    $base_url = $base_url."search";
                    $param = [
                        "query" => $req->search_value
                    ];
                }
            } else {
                $base_url = $base_url."random";
            }
            $temp_customer = curl_get($base_url,$param);
            $quote = null;
            if ($temp_customer["status_code"] == 200) {
                if (isset($temp_customer["data"]["value"])) {
                    $quote = $temp_customer["data"]["value"];
                }
                if (isset($temp_customer["data"]["result"])) {
                    $k = array_rand($temp_customer["data"]["result"]);
                    $quote = $temp_customer["data"]["result"][$k]["value"];
                }
            }else {
                return response()->json([
                    "message" => "Data not found please try again."
                ],500);
            }
            return response()->json([
                "quote" => $quote,
                "status" => "Success.",
                "source" => $base_url
            ],200);
        } catch (\Throwable $th) {
            die(header("HTTP/1.0 502 BAD_GATEWAY"));
        }
    }

    
}
