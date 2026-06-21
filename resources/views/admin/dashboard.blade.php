@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between">
        <div>
            <h1 class="mb-0">Dashboard Monitoring PKLP</h1>
            <p class="text-muted mb-0">Ringkasan QHSE, Audit, Management &amp; Operasi</p>
        </div>
        <span class="badge badge-light border px-3 py-2 mt-2 mt-sm-0">
            <i class="far fa-clock mr-1"></i>{{ now()->translatedFormat('d M Y') }}
        </span>
    </div>
@stop

@section('content')

{{-- ============================ KPI CARDS ============================ --}}
<div class="row">

    <div class="col-12 col-sm-6 col-xl">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ number_format($totalAudit) }}</h3>
                <p>Total Audit</p>
            </div>
            <div class="icon"><i class="fas fa-search"></i></div>
            <a href="{{ url('admin/internal-audits') }}" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($openFinding) }}</h3>
                <p>Open Finding</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
            <a href="{{ url('admin/audit-findings') }}" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ number_format($overdueFinding) }}</h3>
                <p>Overdue Finding</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-times"></i></div>
            <a href="{{ url('admin/audit-findings') }}" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($managementReviewOpen) }}</h3>
                <p>Open Management Review</p>
            </div>
            <div class="icon"><i class="fas fa-users-cog"></i></div>
            <a href="{{ url('admin/management-reviews') }}" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{ number_format($managementVisitOpen) }}</h3>
                <p>Open Management Visit</p>
            </div>
            <div class="icon"><i class="fas fa-clipboard-check"></i></div>
            <a href="{{ url('admin/management-visits') }}" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- ============================ MAN HOURS ============================ --}}
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-business-time mr-1"></i> Total Man Hours Bulanan
        </h3>
        <div class="card-tools">
            <a href="{{ url('admin/man-hours') }}" class="btn btn-tool" title="Kelola Man Hours">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0" style="max-height: 360px;">
        <table class="table table-striped table-hover text-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th class="text-right">Total Man Hours</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monthlyTotals as $item)
                    <tr>
                        <td>{{ $item->month }}</td>
                        <td>{{ $item->year }}</td>
                        <td class="text-right text-monospace">{{ number_format($item->total_hours) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="far fa-folder-open fa-2x d-block mb-2 text-secondary"></i>
                            Belum ada data man hours
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if($monthlyTotals->count())
                <tfoot>
                    <tr class="font-weight-bold bg-light">
                        <td colspan="2">Total Keseluruhan</td>
                        <td class="text-right text-monospace">{{ number_format($monthlyTotals->sum('total_hours')) }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- ============================ QHSE ============================ --}}
<div class="d-flex align-items-center mt-4 mb-2">
    <i class="fas fa-shield-alt text-primary mr-2"></i>
    <h5 class="m-0 text-uppercase text-muted font-weight-bold" style="letter-spacing:.05em;">QHSE</h5>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Incident Trend</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="incidentChart" role="img" aria-label="Tren jumlah insiden per bulan"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">HSSE Category</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="hsseCategoryChart" role="img" aria-label="Jumlah kejadian per kategori HSSE"></canvas></div>
            </div>
        </div>
    </div>
</div>

{{-- ============================ AUDIT ============================ --}}
<div class="d-flex align-items-center mt-4 mb-2">
    <i class="fas fa-clipboard-list text-primary mr-2"></i>
    <h5 class="m-0 text-uppercase text-muted font-weight-bold" style="letter-spacing:.05em;">Audit</h5>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Finding by Type</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="findingChart" role="img" aria-label="Distribusi temuan audit berdasarkan tipe"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Finding Status</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="findingStatusChart" role="img" aria-label="Distribusi temuan audit berdasarkan status"></canvas></div>
            </div>
        </div>
    </div>
</div>

{{-- ============================ MANAGEMENT ============================ --}}
<div class="d-flex align-items-center mt-4 mb-2">
    <i class="fas fa-users-cog text-primary mr-2"></i>
    <h5 class="m-0 text-uppercase text-muted font-weight-bold" style="letter-spacing:.05em;">Management</h5>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Management Review Status</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="reviewStatusChart" role="img" aria-label="Status tindak lanjut management review"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Management Visit Status</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="visitStatusChart" role="img" aria-label="Status management visit"></canvas></div>
            </div>
        </div>
    </div>
</div>

{{-- ============================ OPERATION ============================ --}}
<div class="d-flex align-items-center mt-4 mb-2">
    <i class="fas fa-cogs text-primary mr-2"></i>
    <h5 class="m-0 text-uppercase text-muted font-weight-bold" style="letter-spacing:.05em;">Operation</h5>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Certificate Status</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="certificateChart" role="img" aria-label="Status sertifikat kapal"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Maintenance Status</h3></div>
            <div class="card-body">
                <div class="chart-wrap"><canvas id="maintenanceChart" role="img" aria-label="Status pemeliharaan"></canvas></div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<style>
    /* area chart konsisten & bebas distorsi (token Inter/JetBrains Mono dari design-tokens.css) */
    .chart-wrap { position: relative; height: 300px; width: 100%; }
    .small-box.bg-teal { background-color: #20c997 !important; }
    @media (prefers-reduced-motion: reduce) {
        .small-box, .card { transition: none !important; }
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script src="{{ asset('js/chart-helpers.js') }}"></script>
<script>
    // QHSE
    PKLPCharts.line('incidentChart', @json($incidentMonths), @json($incidentTotals), { label: 'Total Incident' });
    PKLPCharts.bar('hsseCategoryChart', @json($hsseCategoryLabels), @json($hsseCategoryTotals), {
        label: 'HSSE Category',
        colors: ['#16A34A','#22C55E','#F59E0B','#F97316','#FB923C','#EF4444','#DC2626','#7F1D1D']
    });

    // Audit
    PKLPCharts.proportion('findingChart', @json($findingTypes), @json($findingTotals));
    PKLPCharts.proportion('findingStatusChart', @json($findingStatusLabels), @json($findingStatusTotals));

    // Management
    PKLPCharts.proportion('reviewStatusChart', @json($reviewStatusLabels), @json($reviewStatusTotals));
    PKLPCharts.proportion('visitStatusChart', @json($visitStatusLabels), @json($visitStatusTotals));

    // Operation
    PKLPCharts.proportion('certificateChart', @json($certificateLabels), @json($certificateTotals));
    PKLPCharts.proportion('maintenanceChart', @json($maintenanceLabels), @json($maintenanceTotals));
</script>
@stop
@include('partials.logout-script')
