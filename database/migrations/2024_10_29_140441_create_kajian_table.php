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
        Schema::create('kajian', function (Blueprint $table) {
            $table->bigIncrements('kajian_id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('speaker_name');
            $table->string('theme');
            $table->date('date');
            $table->string('location');
            $table->time('start_time');
            $table->time('end_time');
            // $table->foreignId('kehadiran_id')->constrained('kehadiran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajian');
    }
};
