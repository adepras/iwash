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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('capacity');
            $table->text('facilities');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('outlets');
    }
};
