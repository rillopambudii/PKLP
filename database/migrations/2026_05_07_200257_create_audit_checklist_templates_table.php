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
        Schema::create('audit_checklist_templates', function (Blueprint $table) {
            $table->id();

            $table->string('audit_type'); 
            // Vessel / Office

            $table->string('department')->nullable();
            // khusus Office: OPS, Tech, GA, HR, dll

            $table->string('section')->nullable();
            // contoh: Sertifikasi Kapal, Komunikasi, Kamar Mesin

            $table->string('clause')->nullable();
            // contoh: 1.1, 2.3, 10.12

            $table->text('question');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_checklist_templates');
    }
};
