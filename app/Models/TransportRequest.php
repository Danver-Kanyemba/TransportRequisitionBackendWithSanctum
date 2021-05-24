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
        'name',
        'cell',
        'no_of_People',
        'destination',
        'departure_date',
        'departure_time',
        'return_date',
        'return_time',
        'recommended_by_hod',
    ];
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
