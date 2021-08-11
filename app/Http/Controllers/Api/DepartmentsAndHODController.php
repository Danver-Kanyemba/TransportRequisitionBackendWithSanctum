<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepartmentsAndHODController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \App\Models\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // to check if department has an HOD
            $checkValueHod = DB::table('departments')
            ->select('departments.hod')
            ->where('departments.id','=', $id)
            ->get();

            $departmentAndHOD = DB::table('departments')
            ->join('users', 'users.id','=', 'departments.hod')
            ->select('users.name', 'departments.*')
            ->where('departments.id','=', $id)
            ->latest()
            ->get();
            
            $departmentWithoutHOD = DB::table('departments')
            ->select('departments.*')
            ->where('departments.id','=', $id)
            ->latest()
            ->get();

            if ($checkValueHod->contains('hod',0)) {
                # code...
                return ([
                    'data' => $departmentWithoutHOD,
                    'nohod',
                ]);
            } else return ([
                'data' => $departmentAndHOD,
                'withhod'

            ]);
            

            } catch (Exception $error) {
                return response()->json([
                'status_code' => 500,
                'message' => '111 Error in retrieving Departments and HOD',
                'error' => $error,
                ]);
            }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $departments)
    {
        //
    }
}
