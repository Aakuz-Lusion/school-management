<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();
            $table->enum('day', ['Mon','Tue','Wed','Thu','Fri','Sat']);
            $table->timestamps();
            $table->unique(['section_id','day','period_id'], 'uniq_section_day_period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
