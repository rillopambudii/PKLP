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
        Schema::create('audit_findings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internal_audit_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('clause')->nullable();
            $table->text('finding_description');

            $table->string('finding_type')->nullable();
            // OFI / Obs / Minor / Major

            $table->text('corrective_action')->nullable();

            $table->string('person_in_charge')->nullable();

            $table->date('target_date')->nullable();

            $table->date('completion_date')->nullable();

            $table->string('status')->default('Open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_findings');
    }
};
