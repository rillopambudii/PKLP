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
        Schema::create('maintenance_daily_checks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('maintenance_item_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('check_date');

            $table->string('status')->default('Checked');
            // Checked / Not Checked / Finding

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_daily_checks');
    }
};
