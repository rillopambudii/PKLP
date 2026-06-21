<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementReview;

class ManagementReviewSeeder extends Seeder
{
    public function run(): void
    {
        ManagementReview::create([

            'meeting_date' => now(),

            'topic' => 'HSE Performance Review',

            'discussion_result' => 'Need improvement on audit closure',

            'person_in_charge' => 'QHSE Manager',

            'follow_up' => 'Complete overdue findings',

            'follow_up_status' => 'Open',

            'target_date' => now()->addDays(14),

            'realization_date' => null,

            'additional_notes' => 'Priority High',

            'year' => date('Y'),
        ]);
    }
}