<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Admin;
use App\Models\TransportOfficer;

use Hash;

class AuthController extends Controller
{
    public function login( Request $request)
    {
      try {
        $request->validate([
          'email' => 'email|required',
          'password' => 'required'
        ]);
        
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
            'status_code' => 500,
            'message' => 'Unauthorized wrong username or password'
          ]);
        }
        
        $user = Auth::user();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
          'status_code' => 200,
          'access_token' => $tokenResult,
          'token_type' => 'Bearer',
          'message' => 'Login Successfull'
        ]);
    } catch (Exception $error) {
        return response()->json([
          'status_code' => 500,
          'message' => 'Error in Login',
          'error' => $error,
        ]);
    }
      }
      public function index(){
        if(Auth::check()){
          return response()->json([
            'status_code' => 200,
            'message' => true,
          ]); 
        }
        else {
          return response()->json([
            'status_code' => 500,
            'message' => 'user is  not authenticated',
          ]); 
        }
      }

      public function Administrator(){
     
        if(Admin::where('admins.user_id','=', Auth::id())->count() > 0){
          return ([
            'isAdmin' => true,
  
        ]);
      } else return ([
            'isAdmin' => false,
      ]);
    }

    public function checkTransportOfficer(){
     
      if(TransportOfficer::where('transport_officers.officer_id','=', Auth::id())->count() > 0){
        return ([
          'isTransportOfficer' => true,
      ]);
    } else return ([
          'isTransportOfficer' => false,
    ]);

  }    
  }
