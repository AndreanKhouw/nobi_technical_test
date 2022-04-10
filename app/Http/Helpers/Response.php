<?php

namespace App\Http\Helpers;

class Response
{
    public function json($req, $http_code, $http_message, $data)
    {
        return response()->json([
            'code' => $http_message, 
            'data' => $data,
            'req' => $req->all()
        ], $http_code);
    }
}
