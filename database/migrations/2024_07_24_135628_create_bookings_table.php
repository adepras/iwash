<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('service');
            $table->string('package');
            $table->decimal('price', 8, 2);
            $table->integer('estimated');
            $table->date('booking_date');
            $table->string('name');
            $table->string('phone_number');
            $table->string('vehicle_brand');
            $table->string('vehicle_type');
            $table->string('license_plate');
            $table->string('status')->default('waiting');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
