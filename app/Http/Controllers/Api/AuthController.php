<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{

    use RegistersUsers;
    public function register(Request $request)
    {
        // TODO: Make sure the Validator works for the API before creating users
        /* $data = $request->all();
         $validatedData = Validator::make($data, [
         'name' => 'required|max:55',
         'email' => 'email|required|unique:users',
         'username' => 'username|required|unique:users',
         'password' => 'required|confirmed'
     ]);

     $validatedData['password'] = Hash::make($request->password);

     $user = User::create($request);*/
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
            ]);

           // $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json(['message' => 'User created successfully', 'user' => $user],
                 201);
        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['message' => $e], 400);
        }
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken');

        return response(['message' => 'User logged in successfully',
            'user' => auth()->user()->name,'token_type' => 'Bearer',
            'access_token' => $accessToken->plainTextToken], 200);
}

public function logout (Request $request) {
        /*$accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();*/
    print_r($request->all());

    // Revoke all tokens...
   // $user->tokens()->delete();

// Revoke the token that was used to authenticate the current request...
    $request->user()->currentAccessToken()->delete();

// Revoke a specific token...
  //  $user->tokens()->where('id', $tokenId)->delete();

        return response([
            'message' => 'You have been successfully logged out.',
        ], 200);
    }
    }





