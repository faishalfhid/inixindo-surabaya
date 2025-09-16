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
        Schema::create('training_instructors', function (Blueprint $table) {
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('instructor_id');
            $table->timestamps();

            $table->primary(['training_id', 'instructor_id']);

            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_instructors');
    }
};
