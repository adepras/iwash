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
            $table->id();
            $table->string('service');
            $table->string('package');
            $table->integer('price');
            $table->date('booking_date');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('phone_number');
            $table->string('vehicle_brand');
            $table->string('vehicle_type');
            $table->string('license_plate');
            $table->enum('status', ['waiting', 'processing', 'finished'])->default('waiting');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
