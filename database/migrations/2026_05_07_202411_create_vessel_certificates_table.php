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
        Schema::create('vessel_certificates', function (Blueprint $table) {

            $table->id();

            $table->foreignId('master_location_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('certificate_name');

            $table->string('issue_place')
                ->nullable();

            $table->date('issued_date')
                ->nullable();

            $table->date('expired_date')
                ->nullable();

            $table->integer('days_valid')
                ->nullable();

            $table->string('status')
                ->nullable();

            $table->text('remarks')
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
        Schema::dropIfExists('vessel_certificates');
    }
};
