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
        Schema::create('maintenance_checklists', function (Blueprint $table) {
            $table->id();

            $table->string('maintenance_type');
            // Deck / Engine

            $table->foreignId('master_location_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('month');
            $table->year('year');

            $table->string('department')->nullable();
            $table->string('monitored_by')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_checklists');
    }
};
