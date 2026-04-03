<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void{

    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')->constrained()->onDelete('cascade');

        $table->string('type'); // camp, college, short_course

        $table->unsignedBigInteger('reference_id'); 
        // camp_id OR course_id

        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();

        $table->timestamps();
    });
    }
};
