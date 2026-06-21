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
        Schema::create('hsse_statistics', function (Blueprint $table) {

            $table->id();

            $table->foreignId('master_location_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('month');

            $table->year('year');

            $table->integer('nearmiss')->default(0);

            $table->integer('environment')->default(0);

            $table->integer('property_damage')->default(0);

            $table->integer('hipo')->default(0);

            $table->integer('first_aid')->default(0);

            $table->integer('medical_treatment')->default(0);

            $table->integer('lti')->default(0);

            $table->integer('fatality')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsse_statistics');
    }
};
