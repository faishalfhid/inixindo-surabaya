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
        Schema::create('training_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('training_id');
            $table->string('kode_materi');
            $table->timestamps();

            // Primary key gabungan
            $table->primary(['training_id', 'kode_materi']);

            // Foreign keys
            $table->foreign('training_id')
                  ->references('id')
                  ->on('trainings')
                  ->onDelete('cascade');

            $table->foreign('kode_materi')
                  ->references('kode_materi')
                  ->on('materials')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_materials');
    }
};
