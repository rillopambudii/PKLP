<?php

namespace App\Http\Controllers;

use App\Models\InternalAudit;
use App\Models\AuditFinding;
use App\Models\ManagementReview;
use App\Models\ManagementVisit;
use App\Models\HsseStatistic;
use App\Models\VesselCertificate;
use App\Models\MaintenanceDailyCheck;
use App\Models\ManHour;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAudit = InternalAudit::count();

        $openFinding = AuditFinding::where('status', 'Open')->count();

        $overdueFinding = AuditFinding::where('status', 'Open')
            ->whereDate('target_date', '<', Carbon::today())
            ->count();

        $managementReviewOpen = ManagementReview::where('follow_up_status', 'Open')->count();

        $managementVisitOpen = ManagementVisit::where('status', 'Open')->count();
        $monthlyTotals = ManHour::select(
                'month',
                'year',
                DB::raw('SUM(man_hours) as total_hours')
            )
            ->groupBy('month', 'year')
            ->get();

        $incidentChart = HsseStatistic::select(
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
            HsseStatistic::sum('nearmiss'),
            HsseStatistic::sum('environment'),
            HsseStatistic::sum('property_damage'),
            HsseStatistic::sum('hipo'),
            HsseStatistic::sum('first_aid'),
            HsseStatistic::sum('medical_treatment'),
            HsseStatistic::sum('lti'),
            HsseStatistic::sum('fatality'),
        ];

        $findingChart = AuditFinding::select(
                'finding_type',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('finding_type')
            ->get();

        $findingTypes = $findingChart->pluck('finding_type');
        $findingTotals = $findingChart->pluck('total');

        $findingStatusChart = AuditFinding::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        $findingStatusLabels = $findingStatusChart->pluck('status');
        $findingStatusTotals = $findingStatusChart->pluck('total');

        $reviewStatusChart = ManagementReview::select(
                'follow_up_status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('follow_up_status')
            ->get();

        $reviewStatusLabels = $reviewStatusChart->pluck('follow_up_status');
        $reviewStatusTotals = $reviewStatusChart->pluck('total');

        $visitStatusChart = ManagementVisit::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        $visitStatusLabels = $visitStatusChart->pluck('status');
        $visitStatusTotals = $visitStatusChart->pluck('total');

        $certificateChart = VesselCertificate::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        $certificateLabels = $certificateChart->pluck('status');
        $certificateTotals = $certificateChart->pluck('total');

        $maintenanceChart = MaintenanceDailyCheck::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        $maintenanceLabels = $maintenanceChart->pluck('status');
        $maintenanceTotals = $maintenanceChart->pluck('total');

        return view('admin.dashboard', compact(
            'totalAudit',
            'openFinding',
            'overdueFinding',
            'managementReviewOpen',
            'managementVisitOpen',
            'monthlyTotals', 

            'incidentMonths',
            'incidentTotals',
            'hsseCategoryLabels',
            'hsseCategoryTotals',

            'findingTypes',
            'findingTotals',
            'findingStatusLabels',
            'findingStatusTotals',

            'reviewStatusLabels',
            'reviewStatusTotals',
            'visitStatusLabels',
            'visitStatusTotals',

            'certificateLabels',
            'certificateTotals',
            'maintenanceLabels',
            'maintenanceTotals'
        ));
    }
}