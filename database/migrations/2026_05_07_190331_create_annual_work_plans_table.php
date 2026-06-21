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
        Schema::create('annual_work_plans', function (Blueprint $table) {

            $table->id();

            $table->string('activity_name');

            $table->string('sub_activity')
                ->nullable();

            $table->string('participant')
                ->nullable();

            $table->string('frequency')
                ->nullable();

            $table->year('year');

            $table->text('notes')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_work_plans');
    }
};
