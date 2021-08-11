<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportRequest;
use App\Models\Departments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkingIfHod=false;
        $transportRequest = DB::table('transport_requests')
                            ->join('users', 'users.id','=', 'transport_requests.user_id')
                            ->select('users.id','users.name','users.department_id','users.cell','transport_requests.*')
                            ->where('users.department_id','=',Auth::user()->department_id)
                            ->latest()
                            // ->first()
                            ->get();

         if (Departments::where('hod',Auth::id())->exists()) {
            # code...
            $checkingIfHod =true;
        };

        return ([
            'data' => $transportRequest,
            'is_hod_for_department' => $checkingIfHod
           
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
        try {
            $request->validate([
              'names_of_people' => 'required', 
              'no_of_People' => 'required', 
              'destination' => 'required', 
              'departure_date' => 'required', 
              'departure_time' => 'required', 
              'return_date' => 'required', 
              'return_time' => 'required' 
            ]);
            
            TransportRequest::create([
            'names_of_people'     => $request->names_of_people,
            'no_of_People'    => $request->no_of_People,
            'destination'     => $request->destination,
            'departure_date'     => $request->departure_date,
            'departure_time'    => $request->departure_time,
            'return_date'     => $request->return_date,
            'return_time'     => $request->return_time,
             'user_id'      => Auth::id(),  
        ]);
            return response()->json([
                'status_code' => 200,
                'message' => 'Transport Rquested successfull',
                $request->names_of_people,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkingIfHod=false;
        $transportRequest2 = DB::table('transport_requests')
        ->join('users', 'users.id','=', 'transport_requests.user_id')
        ->join('departments', 'departments.id' ,'=', 'users.department_id')
        ->select('users.id','users.name','users.cell','transport_requests.*')
        ->where('transport_requests.id','=',$id)
        ->get();
        
        if (Departments::where('hod',Auth::id())->exists()) {
            # code...
            $checkingIfHod =true;
        };
        return ([
            'data' => $transportRequest2,
            'is_hod_for_department' => $checkingIfHod

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
        //
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
