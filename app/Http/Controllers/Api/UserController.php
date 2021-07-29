<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::all();
        try{
                $transportRequest = DB::table('users')
                            ->join('departments', 'departments.id','=', 'users.department_id')
                            ->select('users.*','departments.*')
                            ->where('users.id','=',Auth::id())
                            ->get();
                            if ($transportRequest) {
                                # code...
                                return response()->json(['data' => $transportRequest]);
                            }else return response()->json([
                                'status_code' => 0,
                                'message' => 'Error in retrieving Departments and HOD',
                                
                                ]);
                            } catch (Exception $error) {
                                return response()->json([
                                'status_code' => 500,
                                'message' => 'Error in Login',
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
        //
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
    public function destroy(User $user)
    {
        //
    }
}
