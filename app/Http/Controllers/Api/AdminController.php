<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $transportRequest = DB::table('admins')
                        ->join('users', 'users.id','=', 'admins.user_id')
                        ->select('users.*')
                        ->get();
                        if ($transportRequest) {
                            # code...
                            return response()->json(['data' => $transportRequest]);
                        }else return response()->json([
                            'status_code' => 0,
                            'message' => 'Error in retrieving Admins',
                            
                            ]);
                        } catch (Exception $error) {
                            return response()->json([
                            'status_code' => 500,
                            'message' => 'Error in Admins',
                            'error' => $error,
                            ]);
                        }                               
}

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
              'id_user_to_add' => 'required',
            ]);
            // User::create($request->all());
            Admin::create([
            'user_id'     => $request->id_user_to_add,
        ]);
            return response()->json([
                'status_code' => 200,
                'message' => 'User Added',
              ]);           

        } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error in adding User',
              'error' => $error,
            ]);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res=DB::table('admins')->where('user_id', '=', $id)->delete();        
                if ($res) {
                    # code...
                    return response()->json([
                        'status'=>'200',
                        'message'=>'User removed successfully',
                      ]);           
                }else{
                    return response()->json([
                        'status'=>'0',
                        'message'=>'Error in removing user',
                      ]);                     
                }

        } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error in adding Department',
              'error' => $error,
            ]);
        }
    }
}
