<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->text('answer_text')->nullable();
            $table->string('attachment')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->decimal('marks', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->enum('status', ['pending','submitted','late','graded'])->default('pending');
            $table->timestamps();
            $table->unique(['assignment_id','student_id'], 'uniq_assignment_student');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
