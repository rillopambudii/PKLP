/* ============================================================
   PKLP — Chart Helpers (Fase 4)
   Pembungkus Chart.js bersama untuk admin & dashboard publik.
   - Theme-aware: warna teks/grid dibaca dari token CSS, ikut dark/light.
   - Status semantik (Open/Overdue/Closed/Valid/Expired/…).
   - Empty-state, tooltip locale id-ID (nilai + %), reduced-motion.
   - Re-render saat tema berubah (event 'pklp:themechange').
   Dipakai: PKLPCharts.line/bar/proportion(id, labels, data, opts)
   ============================================================ */
window.PKLPCharts = (function () {
    'use strict';

    var registry = [];
    var nf = new Intl.NumberFormat('id-ID');
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // status meaning (warna tetap, terbaca di light & dark)
    var STATUS_COLORS = {
        'open': '#F59E0B', 'overdue': '#DC2626', 'pending': '#3B82F6',
        'in progress': '#0EA5E9', 'on progress': '#0EA5E9', 'progress': '#0EA5E9',
        'closed': '#16A34A', 'close': '#16A34A', 'done': '#16A34A',
        'completed': '#16A34A', 'selesai': '#16A34A', 'valid': '#16A34A',
        'active': '#16A34A', 'aktif': '#16A34A',
        'expired': '#DC2626', 'kadaluarsa': '#DC2626', 'rejected': '#DC2626',
        'expiring': '#F59E0B', 'expiring soon': '#F59E0B', 'akan habis': '#F59E0B',
        'draft': '#94A3B8', 'n/a': '#94A3B8'
    };
    var CATEGORICAL = ['#343399','#3B82F6','#0EA5E9','#06B6D4','#D97706','#F59E0B','#7C3AED','#DB2777'];

    function cssVar(name, fallback) {
        var v = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
        return v || fallback;
    }
    function theme() {
        return {
            text: cssVar('--color-text-muted', '#475569'),
            grid: cssVar('--color-border', '#E2E8F0'),
            surface: cssVar('--color-surface', '#FFFFFF'),
            primary: cssVar('--color-primary-600', '#343399')
        };
    }
    function colorFor(label, i) {
        var key = String(label == null ? '' : label).trim().toLowerCase();
        return STATUS_COLORS[key] || CATEGORICAL[i % CATEGORICAL.length];
    }
    function isEmpty(data) {
        if (!data || !data.length) return true;
        return data.every(function (v) { return v == null || Number(v) === 0; });
    }
    function showEmpty(id) {
        var canvas = document.getElementById(id);
        if (!canvas) return;
        var wrap = canvas.closest('.chart-wrap, .chart-box, .chart-box-lg') || canvas.parentNode;
        wrap.innerHTML = '<div class="chart-empty" style="display:flex;flex-direction:column;align-items:center;'
            + 'justify-content:center;height:100%;min-height:200px;color:var(--color-text-subtle);text-align:center;">'
            + '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" '
            + 'style="margin-bottom:8px;"><path d="M3 3v18h18"/><rect x="7" y="11" width="3" height="6"/>'
            + '<rect x="12" y="7" width="3" height="10"/><rect x="17" y="13" width="3" height="4"/></svg>'
            + '<span>Belum ada data</span></div>';
    }

    function applyDefaults() {
        Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
        Chart.defaults.font.size = 12;
        Chart.defaults.color = theme().text;
        // garis sumbu/border default → pakai token border (halus), bukan rgba(0,0,0,.1) hitam
        Chart.defaults.borderColor = theme().grid;
        Chart.defaults.plugins.legend.position = 'bottom';
        Chart.defaults.plugins.legend.labels.usePointStyle = true;
        Chart.defaults.plugins.legend.labels.boxWidth = 10;
        Chart.defaults.animation = reduceMotion ? false : { duration: 600, easing: 'easeOutQuart' };
    }

    function proportionTooltip() {
        return { callbacks: { label: function (ctx) {
            var v = ctx.parsed;
            var total = ctx.dataset.data.reduce(function (a, b) { return a + Number(b || 0); }, 0);
            var pct = total ? Math.round((v / total) * 100) : 0;
            return ' ' + ctx.label + ': ' + nf.format(v) + ' (' + pct + '%)';
        } } };
    }
    function valueTooltip() {
        return { callbacks: { label: function (ctx) {
            var v = ctx.parsed.y != null ? ctx.parsed.y : ctx.parsed;
            return ' ' + nf.format(v);
        } } };
    }
    function axisScales() {
        var t = theme();
        return {
            y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: t.grid } },
            x: { grid: { display: false } }
        };
    }

    function make(id, config) {
        var el = document.getElementById(id);
        if (!el) return null;
        var chart = new Chart(el, config);
        registry.push({ chart: chart, kind: config.type });
        return chart;
    }

    function proportion(id, labels, data, opts) {
        opts = opts || {};
        if (isEmpty(data)) { showEmpty(id); return null; }
        return make(id, {
            type: 'doughnut',
            data: { labels: labels, datasets: [{
                data: data,
                backgroundColor: labels.map(function (l, i) { return colorFor(l, i); }),
                borderColor: theme().surface, borderWidth: 2
            }] },
            options: { responsive: true, maintainAspectRatio: false, cutout: '58%',
                plugins: { tooltip: proportionTooltip() } }
        });
    }

    function bar(id, labels, data, opts) {
        opts = opts || {};
        if (isEmpty(data)) { showEmpty(id); return null; }
        return make(id, {
            type: 'bar',
            data: { labels: labels, datasets: [{
                label: opts.label || '', data: data,
                backgroundColor: opts.colors || theme().primary,
                borderRadius: 4, maxBarThickness: 48
            }] },
            options: { responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: valueTooltip() },
                scales: axisScales() }
        });
    }

    function line(id, labels, data, opts) {
        opts = opts || {};
        if (isEmpty(data)) { showEmpty(id); return null; }
        var p = theme().primary;
        return make(id, {
            type: 'line',
            data: { labels: labels, datasets: [{
                label: opts.label || '', data: data,
                borderColor: p, backgroundColor: 'rgba(52,51,153,.14)',
                fill: true, tension: 0.35, pointRadius: 3, pointHoverRadius: 5, pointBackgroundColor: p
            }] },
            options: { responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: valueTooltip() },
                scales: axisScales() }
        });
    }

    // Re-warnai teks/grid saat tema berubah
    function onThemeChange() {
        var t = theme();
        Chart.defaults.color = t.text;
        Chart.defaults.borderColor = t.grid;
        registry.forEach(function (r) {
            var ch = r.chart;
            if (!ch || !ch.options) return;
            if (ch.options.scales && ch.options.scales.y && ch.options.scales.y.grid) {
                ch.options.scales.y.grid.color = t.grid;
            }
            if (r.kind === 'doughnut' && ch.data.datasets[0]) {
                ch.data.datasets[0].borderColor = t.surface;
            }
            ch.update('none');
        });
    }
    window.addEventListener('pklp:themechange', onThemeChange);

    applyDefaults();
    return { line: line, bar: bar, proportion: proportion, colorFor: colorFor, nf: nf };
})();
