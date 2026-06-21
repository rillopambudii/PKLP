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
        Schema::create('management_visits', function (Blueprint $table) {
            $table->id();

            $table->date('visit_date');
            $table->string('participant')->nullable();

            $table->foreignId('master_location_id')
                ->constrained()
                ->onDelete('cascade');

            $table->text('visit_purpose')->nullable();
            $table->text('findings')->nullable();
            $table->text('corrective_action')->nullable();

            $table->string('person_in_charge')->nullable();
            $table->date('target_date')->nullable();

            $table->string('status')->default('Open');

            $table->date('completion_date')->nullable();

            $table->year('year');

            $table->timestamps();
        });
    }

        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_visits');
    }
};
