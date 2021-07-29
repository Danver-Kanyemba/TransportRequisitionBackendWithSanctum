<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departments;

class HODController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            ->update(['approved_by_hod' => 1]);

            // checking if HOD has already been approved before
            $checkValueofApproveByHod = DB::table('transport_requests')
            ->select('transport_requests.approved_by_hod')
            ->where('transport_requests.id','=', $id)
            ->get();

            if ($affected) {
            # code...
            return response()->json([
            'status_code' => 200,
            'message' => 'Approved successfull',
    
            ]);           
            }elseif ($checkValueofApproveByHod->contains('approved_by_hod',1)) {
            # code...
            return response()->json([
                'status_code' => 200,
                'message' => 'Already Approved',
        
                ]); 
            } else return response()->json([
            'status_code' => 0,
            'message' => 'Error in approving Transport',
            ]);
        }
        // for disapproving 
        elseif ($request->name === 'disapprove') {
            # code...
            # code...
            $checkValueofApproveByTransportOfficer = DB::table('transport_requests')
            ->select('transport_requests.approved_by_transport')
            ->where('transport_requests.id','=', $id)
            ->get();

            if ($checkValueofApproveByTransportOfficer->contains('approved_by_transport',1)) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Disapproved unsuccessfully since it has already been approved by the Transport Office',
            
                    ]);                 
            } else {
                $affected = DB::table('transport_requests')
                ->where('id', $id)
                ->update(['approved_by_hod' => 0]);
    
    
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
                # code...
            }
            




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
