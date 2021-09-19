<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
   * Protcet API route width Token.
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)

  {

    try {

      $credentials['email'] = $request->input('email');
      $credentials['password'] = $request->input('password');
      if (!Auth::attempt($credentials)) {

        return response()->json([

          'status' => 401,
          'message' => 'Unauthorized'

        ]);
      }

      $user = User::where('email', $credentials['email'])->first();
      if (!Hash::check($credentials['password'], $user->password, [])) {
        throw new \Exception('Exception in login');
      }

      $tokenResult = $user->createToken('authToken')->plainTextToken;

      return response()->json([

        'status' => 200,
        'access_token' => $tokenResult,
        'token_type' => 'Bearer',

      ]);
    } catch (\Exception $error) {

      return response()->json([

        'status' => 500,
        'message' => 'Exception in Login',
        'error' => $error,

      ]);
    }
  }

  /**
   * Find the connected User.
   *
   * @return \Illuminate\Http\Response
   */
  public function me(Request $request)
  {
    return $request->user();
  }
}
