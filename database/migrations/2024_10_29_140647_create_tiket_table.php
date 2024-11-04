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
        Schema::create('tiket', function (Blueprint $table) {
            $table->bigIncrements('tiket_id');
            $table->unsignedBigInteger('user')->index()->nullable();
            $table->unsignedBigInteger('kajian')->index();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('kajian_id')->constrained('kajian')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('user')->references('user_id')->on('users');
            $table->foreign('kajian')->references('kajian_id')->on('kajian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};
