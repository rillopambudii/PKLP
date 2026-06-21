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
        Schema::create('maintenance_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('maintenance_checklist_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('equipment')->nullable();
            $table->string('item_no')->nullable();
            $table->string('item_name')->nullable();
            $table->text('task_description')->nullable();
            $table->string('periodical_standard')->nullable();
            $table->string('monitor_by')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_items');
    }
};
