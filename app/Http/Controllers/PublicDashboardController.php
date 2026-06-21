<?php

namespace App\Http\Controllers;

use App\Models\HsseStatistic;
use App\Models\AuditFinding;
use App\Models\VesselCertificate;
use App\Models\MaintenanceDailyCheck;
use App\Models\IncidentResume;
use App\Models\ManagementReview;
use App\Models\ManagementVisit;
use App\Models\MasterLocation;
use App\Models\ManHour;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('public.dashboard', $this->buildData($request));
    }

    public function landing(Request $request)
    {
        return view('public.landing', $this->buildData($request));
    }

    private function buildData(Request $request): array
    {
        $year = $request->year ?? date('Y');
        $month = $request->month;
        $locationId = $request->location_id;

        $locations = MasterLocation::all();

        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oktober', 'Nopember', 'Desember'
        ];

        $hsseQuery = HsseStatistic::query()
            ->where('year', $year)
            ->when($month, fn($q) => $q->where('month', $month))
            ->when($locationId, fn($q) => $q->where('master_location_id', $locationId));

        $incidentQuery = IncidentResume::query()
            ->where('year', $year)
            ->when($locationId, fn($q) => $q->where('master_location_id', $locationId));

        $auditQuery = InternalAudit::query()
            ->where('year', $year)
            ->when($locationId, fn($q) => $q->where('master_location_id', $locationId));

        $certificateQuery = VesselCertificate::query()
            ->where('year', $year)
            ->when($locationId, fn($q) => $q->where('master_location_id', $locationId));

        $manHourQuery = ManHour::query()
            ->where('year', $year)
            ->when($month, fn($q) => $q->where('month', $month))
            ->when($locationId, fn($q) => $q->where('master_location_id', $locationId));

        $totalIncident = (clone $incidentQuery)->count();
        $totalAudit = (clone $auditQuery)->count();
        $totalManHours = (clone $manHourQuery)->sum('man_hours');
        $expiredCertificate = (clone $certificateQuery)->where('status', 'Expired')->count();
        $expiringCertificate = (clone $certificateQuery)->where('status', 'Expiring Soon')->count();

        $openFinding = AuditFinding::where('status', 'Open')->count();

        $openManagementReview = ManagementReview::where('year', $year)
            ->where('follow_up_status', 'Open')
            ->count();

        $openManagementVisit = ManagementVisit::where('year', $year)
            ->where('status', 'Open')
            ->count();

        $incidentChart = (clone $hsseQuery)
            ->select(
                'month',
                DB::raw('SUM(nearmiss + environment + property_damage + hipo + first_aid + medical_treatment + lti + fatality) as total')
            )
            ->groupBy('month')
            ->get();

        $incidentMonths = $incidentChart->pluck('month');
        $incidentTotals = $incidentChart->pluck('total');

        $hsseCategoryLabels = [
            'Nearmiss',
            'Environment',
            'Property Damage',
            'HIPO',
            'First Aid',
            'Medical Treatment',
            'LTI',
            'Fatality',
        ];

        $hsseCategoryTotals = [
            (clone $hsseQuery)->sum('nearmiss'),
            (clone $hsseQuery)->sum('environment'),
            (clone $hsseQuery)->sum('property_damage'),
            (clone $hsseQuery)->sum('hipo'),
            (clone $hsseQuery)->sum('first_aid'),
            (clone $hsseQuery)->sum('medical_treatment'),
            (clone $hsseQuery)->sum('lti'),
            (clone $hsseQuery)->sum('fatality'),
        ];

        $manHoursChart = (clone $manHourQuery)
            ->select('month', DB::raw('SUM(man_hours) as total'))
            ->groupBy('month')
            ->get();

        $manHourMonths = $manHoursChart->pluck('month');
        $manHourTotals = $manHoursChart->pluck('total');

        $findingTypeChart = AuditFinding::select('finding_type', DB::raw('COUNT(*) as total'))
            ->groupBy('finding_type')
            ->get();

        $findingTypeLabels = $findingTypeChart->pluck('finding_type');
        $findingTypeTotals = $findingTypeChart->pluck('total');

        $findingStatusChart = AuditFinding::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $findingStatusLabels = $findingStatusChart->pluck('status');
        $findingStatusTotals = $findingStatusChart->pluck('total');

        $certificateChart = (clone $certificateQuery)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $certificateLabels = $certificateChart->pluck('status');
        $certificateTotals = $certificateChart->pluck('total');

        $maintenanceChart = MaintenanceDailyCheck::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $maintenanceLabels = $maintenanceChart->pluck('status');
        $maintenanceTotals = $maintenanceChart->pluck('total');

        $managementReviewChart = ManagementReview::where('year', $year)
            ->select('follow_up_status', DB::raw('COUNT(*) as total'))
            ->groupBy('follow_up_status')
            ->get();

        $reviewLabels = $managementReviewChart->pluck('follow_up_status');
        $reviewTotals = $managementReviewChart->pluck('total');

        $managementVisitChart = ManagementVisit::where('year', $year)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $visitLabels = $managementVisitChart->pluck('status');
        $visitTotals = $managementVisitChart->pluck('total');

        return compact(
            'year',
            'month',
            'locationId',
            'locations',
            'months',

            'totalIncident',
            'totalAudit',
            'totalManHours',
            'expiredCertificate',
            'expiringCertificate',
            'openFinding',
            'openManagementReview',
            'openManagementVisit',

            'incidentMonths',
            'incidentTotals',
            'hsseCategoryLabels',
            'hsseCategoryTotals',
            'manHourMonths',
            'manHourTotals',

            'findingTypeLabels',
            'findingTypeTotals',
            'findingStatusLabels',
            'findingStatusTotals',

            'certificateLabels',
            'certificateTotals',
            'maintenanceLabels',
            'maintenanceTotals',

            'reviewLabels',
            'reviewTotals',
            'visitLabels',
            'visitTotals'
        );
    }
}