<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('day_slot_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->unsigned();

            $table->tinyInteger('day_number');
            $table->string('status', 20);
            $table->string('work_hours', 255)->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_slot_templates');
    }
};
