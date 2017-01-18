<?php

namespace App\Http\Controllers;

use App\Entities\Elp\Header;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', [ 'except' => [ 'authenticate' ] ]);
    }

    public function index()
    {

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([ 'error' => 'invalid_credentials' ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json([ 'error' => 'could_not_create_token' ], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function getHeaders()
    {
        try {
            $headers = Header::where('issued', true)->get();

            return response()->json([
                'data' => $headers,
            ]);
        } catch (TokenExpiredException $e) {
            dd('Expired');
        } catch (TokenInvalidException $e) {
            dd('Invalid');
        } catch (JWTException $e) {
            dd('JWT Exception');
        }
    }
}
