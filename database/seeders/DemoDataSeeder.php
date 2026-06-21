<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    MasterLocation,
    ManHour,
    HsseStatistic,
    IncidentResume,
    AnnualWorkPlan,
    ManagementReview,
    ManagementVisit,
    InternalAudit,
    AuditFinding,
    AuditChecklistTemplate,
    VesselCertificate,
    MaintenanceChecklist,
    MaintenanceItem,
    MaintenanceDailyCheck,
    User,
};
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@pklp.com'],
            [
                'name' => 'Admin PKLP',
                'password' => Hash::make('Secret123'),
              'role' => 'Super Admin'
            ]
        );

        $dignity = MasterLocation::create([
            'area' => 'Vessel',
            'location' => 'HCA',
            'name' => 'TB. Dignity',
            'type' => 'Vessel',
        ]);

        $fortune = MasterLocation::create([
            'area' => 'Vessel',
            'location' => 'HCA',
            'name' => 'TB. Fortune Paramon',
            'type' => 'Vessel',
        ]);

        $office = MasterLocation::create([
            'area' => 'Shore',
            'location' => 'Shore',
            'name' => 'Office',
            'type' => 'Shore',
        ]);

        $months = ['Jan','Feb','Mar','Apr','May','Jun'];

        foreach ($months as $i => $month) {
            ManHour::create([
                'master_location_id' => $dignity->id,
                'month' => $month,
                'year' => 2026,
                'man_power' => 8,
                'man_hours' => 2900 + ($i * 80),
            ]);

            ManHour::create([
                'master_location_id' => $office->id,
                'month' => $month,
                'year' => 2026,
                'man_power' => 14,
                'man_hours' => 3600 + ($i * 60),
            ]);

            HsseStatistic::create([
                'master_location_id' => $dignity->id,
                'month' => $month,
                'year' => 2026,
                'nearmiss' => $i % 2,
                'environment' => 0,
                'property_damage' => $i == 2 ? 1 : 0,
                'hipo' => 0,
                'first_aid' => $i == 3 ? 1 : 0,
                'medical_treatment' => 0,
                'lti' => $i == 4 ? 1 : 0,
                'fatality' => 0,
            ]);
        }

        IncidentResume::create([
            'investigation_number' => 'IR-2026-001',
            'incident_date' => '2026-02-12',
            'master_location_id' => $dignity->id,
            'area' => 'Vessel',
            'company' => 'PT PKLP',
            'title_of_incident' => 'Minor hand injury',
            'incident_description' => 'Crew mengalami luka ringan saat pekerjaan deck.',
            'root_cause' => 'Kurang penggunaan APD',
            'category' => 'Safety',
            'incident_category' => 'First Aid',
            'severity_level' => 'Low',
            'investigation_status' => 'Closed',
            'completion_target' => '2026-02-20',
            'completion_date' => '2026-02-18',
            'year' => 2026,
        ]);

        VesselCertificate::create([
            'master_location_id' => $dignity->id,
            'certificate_name' => 'Safety Management Certificate',
            'issue_place' => 'Balikpapan',
            'issued_date' => '2025-01-10',
            'expired_date' => Carbon::now()->addDays(20),
            'days_valid' => 20,
            'status' => 'Expiring Soon',
            'remarks' => 'Need renewal',
            'year' => 2026,
        ]);

        VesselCertificate::create([
            'master_location_id' => $fortune->id,
            'certificate_name' => 'Class Certificate',
            'issue_place' => 'Jakarta',
            'issued_date' => '2025-03-01',
            'expired_date' => Carbon::now()->addMonths(8),
            'days_valid' => 240,
            'status' => 'Valid',
            'remarks' => '-',
            'year' => 2026,
        ]);

        AnnualWorkPlan::create([
            'activity_name' => 'Koordinasi',
            'sub_activity' => 'Meeting rutin',
            'participant' => 'Direktur, DPA, Manager',
            'frequency' => 'Monthly',
            'year' => 2026,
            'notes' => '2x/bulan',
        ]);

        ManagementReview::create([
            'meeting_date' => '2026-01-15',
            'topic' => 'HSE Performance Review',
            'discussion_result' => 'Perlu percepatan closing finding audit.',
            'person_in_charge' => 'QHSE Manager',
            'follow_up' => 'Monitoring semua finding overdue',
            'follow_up_status' => 'Open',
            'target_date' => Carbon::now()->subDays(5),
            'realization_date' => null,
            'additional_notes' => 'Overdue',
            'year' => 2026,
        ]);

        ManagementVisit::create([
            'visit_date' => '2026-03-10',
            'participant' => 'Direktur, QHSE Manager',
            'master_location_id' => $dignity->id,
            'visit_purpose' => 'Routine vessel visit',
            'findings' => 'Housekeeping perlu ditingkatkan',
            'corrective_action' => 'Lakukan cleaning dan toolbox meeting',
            'person_in_charge' => 'Master',
            'target_date' => Carbon::now()->addDays(10),
            'status' => 'Open',
            'completion_date' => null,
            'year' => 2026,
        ]);

        $audit = InternalAudit::create([
            'audit_type' => 'Vessel',
            'audit_date' => '2026-04-05',
            'master_location_id' => $dignity->id,
            'department' => null,
            'auditor' => 'Irvan Ardiansyah',
            'auditee' => 'Master TB. Dignity',
            'status' => 'Open',
            'year' => 2026,
        ]);

        AuditFinding::create([
            'internal_audit_id' => $audit->id,
            'clause' => '7.10',
            'finding_description' => 'APAR belum diperiksa bulan berjalan.',
            'finding_type' => 'Minor',
            'corrective_action' => 'Update inspeksi APAR',
            'person_in_charge' => 'Chief Officer',
            'target_date' => Carbon::now()->subDays(3),
            'completion_date' => null,
            'status' => 'Open',
        ]);

        AuditChecklistTemplate::insert([
            [
                'audit_type' => 'Vessel',
                'department' => null,
                'section' => 'Sertifikasi Kapal',
                'clause' => '1.1',
                'question' => 'Sertifikat asli klasifikasi tersedia dan masih berlaku?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_type' => 'Vessel',
                'department' => null,
                'section' => 'Fire Fighting Appliances',
                'clause' => '7.10',
                'question' => 'Pemadam api portable dalam kondisi baik dan dilengkapi tag inspeksi?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_type' => 'Office',
                'department' => 'QHSE',
                'section' => 'Document Control',
                'clause' => '2.1',
                'question' => 'Dokumen QHSE tersedia dan terkendali?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $checklist = MaintenanceChecklist::create([
            'maintenance_type' => 'Deck',
            'master_location_id' => $dignity->id,
            'month' => 'Jan',
            'year' => 2026,
            'department' => 'Deck',
            'monitored_by' => 'Chief Officer',
            'remarks' => 'Monthly deck maintenance',
        ]);

        $item = MaintenanceItem::create([
            'maintenance_checklist_id' => $checklist->id,
            'equipment' => 'Deck Equipment',
            'item_no' => 'D-001',
            'item_name' => 'Mooring Rope',
            'task_description' => 'Check condition of mooring rope',
            'periodical_standard' => 'Daily',
            'monitor_by' => 'Deck Officer',
            'remarks' => '-',
        ]);

        MaintenanceDailyCheck::create([
            'maintenance_item_id' => $item->id,
            'check_date' => Carbon::now(),
            'status' => 'Checked',
            'note' => 'Good condition',
        ]);
    }
}