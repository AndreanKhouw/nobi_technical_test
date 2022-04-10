<?php

use Illuminate\Support\Facades\DB;

function transaction_model($params = NULL) {

    if ($params != NULL) {
        DB::beginTransaction();
        DB::table('balance')
        ->where('user_id', '=', $params["user_id"])
        ->sharedLock()
        ->get();
        DB::table("transaction")->insert([
            "trx_id"=>$params["trx_id"],
            "user_id"=>$params["user_id"],
            "amount"=> $params["amount"],
            "created_at"=> date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
        sleep(30);
        
        $duplicate_checker = json_decode(DB::table("transaction")->where("trx_id","=",$params["trx_id"])->get()->toJSON(), true);
        if (count($duplicate_checker) > 1) {
            DB::rollBack();
            return false;
        }else {
            DB::table("balance")->where([ "user_id" => $params["user_id"] ])->update([
                "amount_available" => DB::raw('amount_available-'.$params["amount"]), 
                "updated_at" => date('Y-m-d H:i:s')
            ]);
        }
        $result = json_decode(DB::table("balance")->where("user_id","=",$params["user_id"])->get()->toJSON(), true);
        DB::commit();
        return $result;
    }
}

function low_high_price_model($params){
    if ($params != NULL) {
        $query = DB::table("coin_csv");
        if (isset($params["currency"])) {
            if ($params["currency"] == "idr") {
                $query->selectRaw("MIN(idr) as lowest_price, MAX(idr) as highest_price,YEAR(created_at), MONTH(created_at)");
            }elseif ($params["currency"] == "usd") {
                $query->selectRaw("MIN(usd) as lowest_price, MAX(usd) as highest_price,YEAR(created_at), MONTH(created_at)");
            }else {
                return false;
            }
        }
        if (isset($params["ticker"])) {
            $query->where("ticker", "=", $params["ticker"]);
        }
        if (isset($params["date_start"])) {
            $query->where("created_at", ">=", $params["date_start"]);
        }
        if (isset($params["date_end"])) {
            $query->where("created_at", "<=", $params["date_end"]);
        }
        $query->orderBy("created_at", "DESC");
        
        $query->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'));
        return json_decode($query->get()->toJSON(), true);
    }
    else{
        return false;
    }
}