<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditChecklistTemplate;

class AuditChecklistTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'audit_type' => 'Vessel',
                'department' => null,
                'section' => 'Sertifikasi Kapal',
                'clause' => '1.1',
                'question' => 'Apakah sertifikat kapal masih berlaku?',
            ],
            [
                'audit_type' => 'Vessel',
                'department' => null,
                'section' => 'Fire Fighting Appliances',
                'clause' => '4.2',
                'question' => 'Apakah APAR tersedia dan terinspeksi?',
            ],
            [
                'audit_type' => 'Office',
                'department' => 'QHSE',
                'section' => 'Document Control',
                'clause' => '2.1',
                'question' => 'Apakah dokumen terkendali tersedia?',
            ],
            [
                'audit_type' => 'Office',
                'department' => 'HR',
                'section' => 'Training',
                'clause' => '3.1',
                'question' => 'Apakah training matrix diperbarui?',
            ],
        ];

        foreach ($templates as $template) {
            AuditChecklistTemplate::create($template);
        }
    }
}