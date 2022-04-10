<?php

namespace App\Http\Middleware;

use Closure;
use ReallySimpleJWT\Token;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if ($request->header('Authorization') == null) {
            return response()->json(["message"=>"You need token to continue this action!"],500);
        }
        $result_expiration = Token::validateExpiration($request->header('Authorization'), env('JWT_SECRET'));
        if ($result_expiration == false ) {
            return response()->json(["message"=>"Token is not valid, please login again!"],500);
        }
        return $next($request);
    }
}
