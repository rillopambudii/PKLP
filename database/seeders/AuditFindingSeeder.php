<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditFinding;

class AuditFindingSeeder extends Seeder
{
    public function run(): void
    {
        AuditFinding::create([

            'internal_audit_id' => 1,

            'clause' => '1.1',

            'finding_description' => 'Fire extinguisher inspection expired',

            'finding_type' => 'Major',

            'corrective_action' => 'Replace and inspect extinguisher',

            'person_in_charge' => 'Chief Officer',

            'target_date' => now()->addDays(7),

            'completion_date' => null,

            'status' => 'Open',
        ]);

        AuditFinding::create([

            'internal_audit_id' => 2,

            'clause' => '2.3',

            'finding_description' => 'Document numbering inconsistent',

            'finding_type' => 'Minor',

            'corrective_action' => 'Update document numbering',

            'person_in_charge' => 'Document Control',

            'target_date' => now()->subDays(3),

            'completion_date' => null,

            'status' => 'Open',
        ]);
    }
}