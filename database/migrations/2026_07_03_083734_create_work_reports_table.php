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
        Schema::create('work_reports', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('employee_id')->constrained(); //user_id 
            $table->date('work_report_date'); 
            $table->foreignId('project_id'); 
            // $table->text('description'); 
            $table->integer('duration_minutes'); // Stores time in minutes for precision 

            // $table->json('tasks_completed'); // Store as JSON for flexibility 
            $table->string('status')->default('submitted');
            $table->unique(['employee_id', 'project_id', 'work_report_date']);  // Ensure one report per day per employee
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_reports');
    }
};
