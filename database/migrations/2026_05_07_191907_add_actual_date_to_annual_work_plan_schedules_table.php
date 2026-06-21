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
        Schema::table(
            'annual_work_plan_schedules',

            function (Blueprint $table) {

                $table->date('actual_date')
                    ->nullable();

            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annual_work_plan_schedules', function (Blueprint $table) {
            $table->dropColumn('actual_date');
        });
    }
};
