<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender');
            $table->date('date_of_birth')->nullable();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('level_id')->constrained()->onDelete('cascade');
            
            // CORRECTED: Change from 'gurdian_id' to 'guardian_id'
            // CORRECTED: Change from 'gurdians' to 'guardians'
            $table->foreignId('guardian_id')->nullable()->constrained('guardians')->onDelete('set null');
            
            $table->string('index_number')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};