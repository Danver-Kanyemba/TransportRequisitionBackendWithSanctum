<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departments;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Departments::all();
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
              'name' => 'required',
            ]);
            // User::create($request->all());
            Departments::create([
            'department_name'     => $request->name,
        ]);
            return response()->json([
                'status_code' => 200,
                'message' => 'Department Added',
              ]);           

        } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error in adding Department',
              'error' => $error,
            ]);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // not yet araranged and completed
        
           
        try {
            // $request->validate([
            //     'name' => 'required', 

            // ]);

            // $transportRequest = DB::table('departments')
            // ->join('users', 'users.id','=', 'departments.hod')
            // ->select('users.id','users.name','users.cell','departments.*')
            // ->get();

            $affected = DB::table('departments')
                        ->select(['department_name'])
                        ->where('id', $id)
                        ->get();
            if ($affected) {
                # code...
                return $affected;           
            } else return response()->json([
                'status_code' => 0,
                'message' => 'Error in retrieving Department',
                
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
              'name' => 'required', 

            ]);

            if ($request->name === 'admin_update_HOD') {
            
                $affectedHOD = DB::table('departments')
                ->where('id', $id)
                ->update(['hod' => $request->hod]);                
                if ($affectedHOD) {
                    # code...
                    return response()->json([
                        'status_code' => 200,
                        'message' => 'HOD set successfull',
                        
                      ]);     
            }
        }else{
            $affected = DB::table('departments')
                            ->where('id', $id)
                            ->update(['department_name' => $request->name]);
            if ($affected) {
                # code...
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Department renamed successfull',
                    
                  ]);           
            } else return response()->json([
                'status_code' => 0,
                'message' => 'Error in renaming Department',
              ]);
            }
            
            } catch (Exception $error) {
                return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
                ]);
            }             
    }

    /**++
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $res=DB::table('departments')->where('id', '=', $id)->delete();        
                if ($res) {
                    # code...
                    return response()->json([
                        'status'=>'200',
                        'message'=>'Department deleted successfully',
                      ]);           
                }else{
                    return response()->json([
                        'status'=>'0',
                        'message'=>'Error in deleting Department',
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
