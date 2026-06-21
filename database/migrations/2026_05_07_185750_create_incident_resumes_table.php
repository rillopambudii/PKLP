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
        Schema::create('incident_resumes', function (Blueprint $table) {

            $table->id();

            $table->string('investigation_number');

            $table->date('incident_date');

            $table->foreignId('master_location_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('area');

            $table->string('company');

            $table->string('title_of_incident');

            $table->text('incident_description');

            $table->text('root_cause')
                ->nullable();

            $table->string('category')
                ->nullable();

            $table->string('incident_category')
                ->nullable();

            $table->string('severity_level')
                ->nullable();

            $table->string('investigation_status')
                ->default('Open');

            $table->date('completion_target')
                ->nullable();

            $table->date('completion_date')
                ->nullable();

            $table->year('year');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_resumes');
    }
};
