<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRequest extends Model
{
    use HasFactory;
    protected $fillable =[
        'seen',
        'user_id',
        'names_of_people',
        'cell',
        'no_of_People',
        'destination',
        'departure_date',
        'departure_time',
        'return_date',
        'return_time',
        'approved_by_hod',
        'approved_by_transport',
    ];
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
