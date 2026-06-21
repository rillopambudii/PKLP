<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementVisit;

class ManagementVisitSeeder extends Seeder
{
    public function run(): void
    {
        ManagementVisit::create([

            'visit_date' => now(),

            'participant' => 'Direktur, QHSE Manager',

            'master_location_id' => 1,

            'visit_purpose' => 'Routine Management Visit',

            'findings' => 'Unsafe PPE usage observed',

            'corrective_action' => 'Conduct toolbox meeting',

            'person_in_charge' => 'Captain',

            'target_date' => now()->addDays(5),

            'status' => 'Open',

            'completion_date' => null,

            'year' => date('Y'),
        ]);
    }
}