<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportRequest;
use Illuminate\Support\Facades\Auth;

class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportRequest = TransportRequest::all();
        return response()->json([
            $transportRequest
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
              'name' => 'required', 
              'no_of_People' => 'required', 
              'destination' => 'required', 
              'departure_date' => 'required', 
              'return_date' => 'required', 
              'return_time' => 'required' 
            ]);
            
            TransportRequest::create([
            'name'     => $request->name,
            'no_of_People'    => $request->no_of_People,
            'destination'     => $request->destination,
            'departure_date'     => $request->departure_date,
            'departure_time'    => $request->departure_time,
            'return_date'     => $request->return_date,
            'return_time'     => $request->departure_date,
             'user_id'      => Auth::id(),  
        ]);
            return response()->json([
                'status_code' => 200,
                'message' => 'Transport Rquested successfull',
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
