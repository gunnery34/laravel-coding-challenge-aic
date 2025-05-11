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
        Schema::create('employee_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->text('task_description');
            $table->date('date');
            $table->integer('hours_spent');
            $table->decimal('hourly_rate', 8, 2);
            $table->decimal('additional_charges', 8, 2)->default(0);
            $table->decimal('total_remuneration', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_tasks');
    }
};
