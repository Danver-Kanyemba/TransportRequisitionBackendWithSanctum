<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('approved_by_hod')->default(0);
            $table->boolean('approved_by_transport')->default(0);
            $table->integer('user_id')->index();
            $table->string('names_of_people');
            $table->integer('no_of_People');
            $table->string('destination');
            $table->date('departure_date');
            $table->string('departure_time');            
            $table->date('return_date');
            $table->string('return_time');
//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_requests');
    }
}
