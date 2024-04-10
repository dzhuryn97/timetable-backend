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
        Schema::create('day_slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('doctor_id')->unsigned();
            $table->string('status',20);
            $table->string('work_hours',255)->nullable();
            $table->string('absent_reason',255)->nullable();
            $table->foreignId('replacement_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('replacement_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_slots');
    }
};
