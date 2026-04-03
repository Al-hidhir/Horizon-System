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
       Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('full_name');
    $table->string('gender');
    $table->date('date_of_birth')->nullable();

    $table->unsignedBigInteger('school_id');
    $table->unsignedBigInteger('level_id');
    $table->unsignedBigInteger('guardian_id');

    $table->string('index_number')->nullable();
    $table->string('photo')->nullable();

    $table->timestamps();

    $table->foreign('school_id')->references('id')->on('schools');
    $table->foreign('level_id')->references('id')->on('levels');
    $table->foreign('guardian_id')->references('id')->on('guardians');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
