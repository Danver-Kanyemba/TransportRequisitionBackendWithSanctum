<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransportOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $transportRequest = DB::table('transport_officers')
                        ->join('users', 'users.id','=', 'transport_officers.officer_id')
                        ->select('users.*')
                        ->get();
                        if ($transportRequest) {
                            # code...
                            return response()->json(['data' => $transportRequest]);
                        }else return response()->json([
                            'status_code' => 0,
                            'message' => 'Error in retrieving Transport Officers',
                            
                            ]);
                        } catch (Exception $error) {
                            return response()->json([
                            'status_code' => 500,
                            'message' => 'Error in Transport Officers',
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
            TransportOfficer::create([
            'officer_id'     => $request->id_user_to_add,
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
     * @param  \App\Models\TransportOfficer  $transportOfficer
     * @return \Illuminate\Http\Response
     */
    public function show(TransportOfficer $transportOfficer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransportOfficer  $transportOfficer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransportOfficer $transportOfficer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransportOfficer  $transportOfficer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                try {
            $res=DB::table('transport_officers')->where('officer_id', '=', $id)->delete();        
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
        }    }
}
