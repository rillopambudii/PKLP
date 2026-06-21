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
        Schema::create('internal_audits', function (Blueprint $table) {

            $table->id();

            $table->string('audit_type');
            // Vessel / Office

            $table->date('audit_date');

            $table->foreignId('master_location_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->string('department')
                ->nullable();

            $table->string('auditor')
                ->nullable();

            $table->string('auditee')
                ->nullable();

            $table->string('status')
                ->default('Open');

            $table->year('year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_audits');
    }
};
