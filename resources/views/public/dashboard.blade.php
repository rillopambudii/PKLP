<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Executive Dashboard - PKLP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/design-tokens.css') }}" rel="stylesheet">
    {{-- anti-flash: terapkan tema sebelum paint --}}
    <script>try{if(localStorage.getItem('pklp-theme')==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Token-driven (design-system/MASTER.md). Light + dark-ready. */
        body {
            background: var(--color-bg);
            font-family: var(--font-sans);
            color: var(--color-text);
        }

        .navbar-custom {
            background: var(--color-surface);
            border-bottom: 1px solid var(--color-border);
        }
        .navbar-brand { color: var(--color-text); font-weight: 700; }

        .hero {
            background: linear-gradient(135deg, var(--color-primary-700), var(--color-primary-600));
            color: #fff;
            border-radius: var(--radius-lg);
            padding: 34px;
            margin-top: 28px;
            box-shadow: var(--shadow-e2);
        }
        .hero h1 { font-weight: 700; }

        .filter-card,
        .kpi-card,
        .chart-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-e1);
        }

        .filter-card { padding: 22px; margin-top: 22px; }

        .kpi-card { padding: 20px; height: 100%; }

        .kpi-title {
            color: var(--color-text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .kpi-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--color-text);
            font-family: var(--font-mono);
            font-feature-settings: "tnum";
            margin: 4px 0;
        }
        .kpi-card .text-muted { color: var(--color-text-subtle) !important; font-size: 13px; }

        .chart-card { padding: 22px; height: 100%; }
        .chart-card h5 { color: var(--color-text); }
        .chart-box { height: 280px; position: relative; }
        .chart-box-lg { height: 340px; position: relative; }

        .section-title {
            font-weight: 700;
            color: var(--color-text);
            margin-top: 36px;
            margin-bottom: 18px;
        }

        .badge-soft {
            background: var(--color-primary-50);
            color: var(--color-primary-700);
            border: 1px solid var(--color-primary-100);
            border-radius: 999px;
            padding: 7px 14px;
            font-weight: 600;
            font-size: 13px;
        }
        [data-theme="dark"] .badge-soft {
            background: rgba(74,73,176,.20);
            color: var(--color-primary);
            border-color: rgba(74,73,176,.45);
        }

        .footer { color: var(--color-text-muted); font-size: 13px; padding: 30px 0; }

        /* form + CTA pakai token */
        .form-control, .form-select {
            border-radius: var(--radius-sm);
            border-color: var(--color-border);
            min-height: 44px;
            color: var(--color-text);
            background: var(--color-surface);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px var(--color-primary-300);
        }
        .form-label { color: var(--color-text); font-weight: 600; }
        .btn-primary {
            background: var(--color-primary-600);
            border-color: var(--color-primary-600);
            border-radius: var(--radius-sm);
            min-height: 44px;
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--color-primary-700);
            border-color: var(--color-primary-700);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
              <img src="https://www.pklp.co.id/wp-content/uploads/2023/11/Logo-PKLP-Besar-1-120x61.png" alt="Logo" height="50" class="d-inline-block align-text-top"> PT. Pelayaran Karya Lentari Perdana
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="badge-soft">
                Executive Dashboard
            </span>
            <button type="button" class="btn btn-sm" data-theme-toggle
                    style="border:1px solid var(--color-border);border-radius:var(--radius-sm);color:var(--color-text);width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;">
                <svg data-theme-icon width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>
            </button>
        </div>
    </div>
</nav>

<div class="container">

    <div class="hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Fleet Management Executive Dashboard</h1>
                <p class="mb-0 text-white-50">
                    Integrated monitoring for QHSE, Audit, Management, Operation, Certificate, and Maintenance.
                </p>
            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <h6 class="text-white-50 mb-1">Current View</h6>
                <h3 class="mb-0">
                    {{ $month ?? 'All Months' }} {{ $year }}
                </h3>
            </div>
        </div>
    </div>

    <form method="GET" action="/public-dashboard" class="filter-card">
        <div class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="form-label fw-bold">Year</label>
                <input type="number"
                       name="year"
                       class="form-control"
                       value="{{ $year }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Month</label>
                <select name="month" class="form-control">
                    <option value="">All Months</option>

                    @foreach($months as $m)
                        <option value="{{ $m }}"
                            {{ $month == $m ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Location / Vessel</label>
                <select name="location_id" class="form-control">
                    <option value="">All Locations</option>

                    @foreach($locations as $location)
                        <option value="{{ $location->id }}"
                            {{ $locationId == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    Apply Filter
                </button>
            </div>

        </div>
    </form>

    <h4 class="section-title">Key Performance Indicators</h4>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Total Incident</div>
                <div class="kpi-number">{{ $totalIncident }}</div>
                <div class="text-muted">Incident Resume</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Total Audit</div>
                <div class="kpi-number">{{ $totalAudit }}</div>
                <div class="text-muted">Internal Audit</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Total Man Hours</div>
                <div class="kpi-number">{{ number_format($totalManHours) }}</div>
                <div class="text-muted">Working Hours</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Open Finding</div>
                <div class="kpi-number">{{ $openFinding }}</div>
                <div class="text-muted">Audit Finding</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Expiring Certificate</div>
                <div class="kpi-number">{{ $expiringCertificate }}</div>
                <div class="text-muted">Need Attention</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Expired Certificate</div>
                <div class="kpi-number">{{ $expiredCertificate }}</div>
                <div class="text-muted">Critical</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Open Review</div>
                <div class="kpi-number">{{ $openManagementReview }}</div>
                <div class="text-muted">Management Review</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-title">Open Visit</div>
                <div class="kpi-number">{{ $openManagementVisit }}</div>
                <div class="text-muted">Management Visit</div>
            </div>
        </div>

    </div>

    <h4 class="section-title">QHSE Analytics</h4>

    <div class="row g-4">

        <div class="col-md-8">
            <div class="chart-card">
                <h5 class="fw-bold">Incident Trend</h5>
                <div class="chart-box-lg">
                    <canvas id="incidentChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="chart-card">
                <h5 class="fw-bold">HSSE Category</h5>
                <div class="chart-box">
                    <canvas id="hsseCategoryChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="chart-card">
                <h5 class="fw-bold">Man Hours Trend</h5>
                <div class="chart-box-lg">
                    <canvas id="manHourChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <h4 class="section-title">Audit Analytics</h4>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Finding by Type</h5>
                <div class="chart-box">
                    <canvas id="findingTypeChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Finding Status</h5>
                <div class="chart-box">
                    <canvas id="findingStatusChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <h4 class="section-title">Management Analytics</h4>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Management Review Status</h5>
                <div class="chart-box">
                    <canvas id="reviewChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Management Visit Status</h5>
                <div class="chart-box">
                    <canvas id="visitChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <h4 class="section-title">Operation Analytics</h4>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Certificate Status</h5>
                <div class="chart-box">
                    <canvas id="certificateChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="fw-bold">Maintenance Status</h5>
                <div class="chart-box">
                    <canvas id="maintenanceChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="footer text-center">
        PKLP Fleet Management System © {{ date('Y') }}
    </div>

</div>

<script src="{{ asset('js/chart-helpers.js') }}"></script>
<script>
    // Helper bersama (chart-helpers.js): theme-aware, status colors, empty-state, tooltip locale.
    PKLPCharts.line('incidentChart', @json($incidentMonths), @json($incidentTotals), { label: 'Total Incident' });
    PKLPCharts.proportion('hsseCategoryChart', @json($hsseCategoryLabels), @json($hsseCategoryTotals));
    PKLPCharts.line('manHourChart', @json($manHourMonths), @json($manHourTotals), { label: 'Man Hours' });

    PKLPCharts.proportion('findingTypeChart', @json($findingTypeLabels), @json($findingTypeTotals));
    PKLPCharts.proportion('findingStatusChart', @json($findingStatusLabels), @json($findingStatusTotals));

    PKLPCharts.proportion('reviewChart', @json($reviewLabels), @json($reviewTotals));
    PKLPCharts.proportion('visitChart', @json($visitLabels), @json($visitTotals));

    PKLPCharts.proportion('certificateChart', @json($certificateLabels), @json($certificateTotals));
    PKLPCharts.proportion('maintenanceChart', @json($maintenanceLabels), @json($maintenanceTotals));
</script>

<script src="{{ asset('js/theme-toggle.js') }}"></script>

</body>
</html>