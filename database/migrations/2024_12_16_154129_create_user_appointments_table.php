<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_appointments', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('appointment_id')->constrained();
            $table->primary(['user_id', 'appointment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_appointments');
    }
};
