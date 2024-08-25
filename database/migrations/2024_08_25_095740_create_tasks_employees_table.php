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
        Schema::create('tasks_employees', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->index();
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->unsignedBigInteger('employee_id')->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->tinyInteger('status')->default(0);

            $table->primary(['task_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_employees');
    }
};
