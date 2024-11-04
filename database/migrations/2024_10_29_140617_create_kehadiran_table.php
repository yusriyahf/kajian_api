<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->bigIncrements('kehadiran_id');
            $table->integer('total');
            $table->integer('total_male');
            $table->integer('total_female');
            $table->unsignedBigInteger('kajian')->index();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('kajian_id')->constrained('kajian')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('kajian')->references('kajian_id')->on('kajian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
