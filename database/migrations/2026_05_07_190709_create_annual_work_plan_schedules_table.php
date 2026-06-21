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
        Schema::create('annual_work_plan_schedules', function (Blueprint $table) {

            $table->id();

            $table->foreignId('annual_work_plan_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('month');

            $table->integer('week');

            $table->boolean('is_planned')
                ->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_work_plan_schedules');
    }
};
