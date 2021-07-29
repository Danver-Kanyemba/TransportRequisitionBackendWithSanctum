<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departments;

class TransportOfficer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkingIfTransportOfficer=false;
        $transportManagerRequest = DB::table('transport_requests')
                            ->join('users', 'users.id','=', 'transport_requests.user_id')
                            ->select('users.id','users.name','users.department_id','users.cell','transport_requests.*')
                            ->where('transport_requests.approved_by_hod',1)
                            ->get();

        //  if (Departments::where('hod',Auth::id())->exists()) {
        //     # code...
        //     $checkingIfTransportOfficer =true;
        // };

        return ([
            'data' => $transportManagerRequest,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transportRequest2 = DB::table('transport_requests')
        ->join('users', 'users.id','=', 'transport_requests.user_id')
        ->join('departments', 'departments.id' ,'=', 'users.department_id')
        ->select('users.id','users.name','users.cell','transport_requests.*')
        ->where('transport_requests.id','=',$id)
        ->get();
        
        return ([
            'data' => $transportRequest2,
            'is_transport_officer' => 1,
        ]);

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
        try{
            $request->validate([
                'name' => 'required', 
    
              ]);
              
            if ($request->name === 'approve') {
                # code...
                $affected = DB::table('transport_requests')
                ->where('id', $id)
                ->update(['approved_by_transport' => 1]);
    
    
                if ($affected) {
                # code...
                return response()->json([
                'status_code' => 200,
                'message' => 'Approved successfull',
        
                ]);           
                } else return response()->json([
                'status_code' => 0,
                'message' => 'Error in approving Transport',
                ]);
            } elseif ($request->name === 'disapprove') {
                # code...
                # code...
                $affected = DB::table('transport_requests')
                ->where('id', $id)
                ->update(['approved_by_transport' => 0]);
    
    
                if ($affected) {
                # code...
                return response()->json([
                'status_code' => 200,
                'message' => 'Disapproved successfully',
        
                ]);           
                } else return response()->json([
                'status_code' => 0,
                'message' => 'Error in disapproving Transport',
                ]);
    
    
    
    
            }
            
            else {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Error in Approving',
                ]);
            }
        }
            catch (Exception $error) {
            return response()->json([
            'status_code' => 500,
            'message' => 'Error in Approving',
            'error' => $error,
            ]);
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
