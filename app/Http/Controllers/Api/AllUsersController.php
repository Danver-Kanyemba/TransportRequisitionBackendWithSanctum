<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AllUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersRequest = DB::table('users')
        ->join('departments', 'departments.id' ,'=', 'users.department_id')
        ->select('users.id','users.name','users.cell','departments.department_name')
        ->get();
        return $usersRequest;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
            $res=DB::table('users')->where('id', '=', $id)->delete();        
                if ($res) {
                    # code...
                    return response()->json([
                        'status'=>'200',
                        'message'=>'User deleted successfully',
                      ]);           
                }else{
                    return response()->json([
                        'status'=>'0',
                        'message'=>'Error in deleting User',
                      ]);                     
                }

        } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error in adding User',
              'error' => $error,
            ]);
        }
    }
}
