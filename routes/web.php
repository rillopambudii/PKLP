<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\MasterLocationController;
use App\Http\Controllers\ManHourController;
use App\Http\Controllers\HsseStatisticController;
use App\Http\Controllers\IncidentResumeController;
use App\Http\Controllers\AnnualWorkPlanController;
use App\Http\Controllers\ManagementReviewController;
use App\Http\Controllers\ManagementVisitController;
use App\Http\Controllers\InternalAuditController;
use App\Http\Controllers\AuditFindingController;
use App\Http\Controllers\AuditChecklistTemplateController;
use App\Http\Controllers\VesselCertificateController;
use App\Http\Controllers\MaintenanceChecklistController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return redirect()->route('landing');
});

Route::get('/public-dashboard', [PublicDashboardController::class, 'index']);

// Landing page publik (hero parallax + chart live) — design-system/pages/landing.md
Route::get('/landing', [PublicDashboardController::class, 'landing'])->name('landing');

// Living style guide — preview design system dari design-system/MASTER.md
Route::view('/design-system', 'design-system')->name('design-system');

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::resource('admin/users', UserManagementController::class);
        Route::resource('admin/master-location', MasterLocationController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | QHSE
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:Admin QHSE'])->group(function () {
        Route::resource('admin/man-hours', ManHourController::class);
        Route::resource('admin/hsse-statistics', HsseStatisticController::class);
        Route::resource('admin/incident-resume', IncidentResumeController::class);
        Route::resource('admin/annual-work-plans', AnnualWorkPlanController::class);
        Route::resource('admin/management-reviews', ManagementReviewController::class);
        Route::resource('admin/management-visits', ManagementVisitController::class);
        Route::resource('admin/internal-audits', InternalAuditController::class);
        Route::resource('admin/audit-findings', AuditFindingController::class);
        Route::resource('admin/audit-checklist-templates', AuditChecklistTemplateController::class);

        Route::get(
            'admin/internal-audits/{id}/checklist',
            [InternalAuditController::class, 'checklist']
        );

        Route::post(
            'admin/internal-audits/{id}/checklist',
            [InternalAuditController::class, 'storeChecklist']
        );

        Route::get(
            'admin/internal-audits/{id}/export-pdf',
            [InternalAuditController::class, 'exportPdf']
        );

        Route::get(
            'admin/annual-work-plans/{id}/schedules',
            [AnnualWorkPlanController::class, 'schedules']
        );

        Route::post(
            'admin/annual-work-plans/{id}/schedules',
            [AnnualWorkPlanController::class, 'storeSchedule']
        );
    });

    /*
    |--------------------------------------------------------------------------
    | OPERATION
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:Admin Operation'])->group(function () {
        Route::resource('admin/vessel-certificates', VesselCertificateController::class);
        Route::resource('admin/maintenance-checklists', MaintenanceChecklistController::class);

        Route::get(
            'admin/maintenance-checklists/{id}/items',
            [MaintenanceChecklistController::class, 'items']
        );

        Route::post(
            'admin/maintenance-checklists/{id}/items',
            [MaintenanceChecklistController::class, 'storeItem']
        );

        Route::post(
            'admin/maintenance-items/{id}/daily-checks',
            [MaintenanceChecklistController::class, 'storeDailyCheck']
        );

        Route::get(
            'admin/vessel-certificates-export',
            [VesselCertificateController::class, 'exportExcel']
        );
    });
});

Route::get('/force-logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    });


require __DIR__.'/auth.php';