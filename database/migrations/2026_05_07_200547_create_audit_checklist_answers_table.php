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
        Schema::create('audit_checklist_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internal_audit_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('audit_checklist_template_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('answer')->nullable();
            // Ya / Tidak / N/A

            $table->string('finding_type')->nullable();
            // OFI / Obs / Minor / Major

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_checklist_answers');
    }
};
