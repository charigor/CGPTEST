<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Debugbar;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  public function Login(Request $request) {

      $user = User::where('email', $request->email)->first();

            if (!$user) {
                return false;
            }
      return $user->createToken($request->email)->plainTextToken;
  }
}
