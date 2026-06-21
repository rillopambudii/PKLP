<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternalAudit;

class InternalAuditSeeder extends Seeder
{
    public function run(): void
    {
        InternalAudit::create([

            'audit_type' => 'Vessel',

            'audit_date' => now(),

            'master_location_id' => 1,

            'department' => null,

            'auditor' => 'Irvan Ardiansyah',

            'auditee' => 'Captain Dignity',

            'status' => 'Open',

            'year' => date('Y'),
        ]);

        InternalAudit::create([

            'audit_type' => 'Office',

            'audit_date' => now(),

            'master_location_id' => 3,

            'department' => 'QHSE',

            'auditor' => 'Leoni Aulina',

            'auditee' => 'QHSE Team',

            'status' => 'Closed',

            'year' => date('Y'),
        ]);
    }
}