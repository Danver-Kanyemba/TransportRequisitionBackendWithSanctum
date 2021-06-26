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
            $table->boolean('seen')->default(0);
            $table->integer('user_id')->index();
            $table->string('name');
            $table->string('cell');
            $table->integer('no_of_People');
            $table->string('destination');
            $table->date('departure_date');
            $table->time('departure_time');            
            $table->date('return_date');
            $table->time('return_time');
            $table->boolean('recommended_by_hod')->default(0);
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
