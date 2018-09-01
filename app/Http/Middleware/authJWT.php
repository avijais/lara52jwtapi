<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // TOKEN FROM POST BODY
            // $token = $request->input('token');
            
            $token = $request->header('token');
            $user = JWTAuth::toUser($token);
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'error', 'msg'=>'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'error', 'msg'=>'Token is Expired']);
            } else{
                return response()->json(['status' => 'error', 'msg'=>'Something is wrong OR Token is missing']);
            }
        }
        return $next($request);
    }
}
