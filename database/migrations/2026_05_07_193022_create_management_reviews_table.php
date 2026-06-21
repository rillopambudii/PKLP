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
        Schema::create('management_reviews', function (Blueprint $table) {

            $table->id();

            $table->date('meeting_date');

            $table->string('topic');

            $table->text('discussion_result');

            $table->string('person_in_charge');

            $table->text('follow_up');

            $table->string('follow_up_status')
                ->default('Open');

            $table->date('target_date')
                ->nullable();

            $table->date('realization_date')
                ->nullable();

            $table->text('additional_notes')
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
        Schema::dropIfExists('management_reviews');
    }
};
