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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id')->index();
            $table->string('name');
            $table->string('email');
            $table->string('token', 64)->nullable()->unique(); // token untuk konfirmasi
            $table->timestamp('confirmed_at')->nullable();
            $table->json('meta')->nullable(); // optional: data diri tambahan
            $table->timestamps();

            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');

            // unique agar satu email tidak bisa didaftarkan ganda pada 1 training
            $table->unique(['training_id', 'email']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
