<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT. PKLP Marine Offshore — Sistem Monitoring QHSE &amp; Fleet</title>
    <meta name="description"
        content="Platform monitoring terintegrasi PT. Pelayaran Karya Lentari Perdana: QHSE, audit, man-hours, sertifikat kapal, maintenance, dan management review dalam satu dashboard.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/design-tokens.css') }}" rel="stylesheet">
    {{-- anti-flash: terapkan tema sebelum paint --}}
    <script>try { if (localStorage.getItem('pklp-theme') === 'dark') document.documentElement.setAttribute('data-theme', 'dark'); } catch (e) { }</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ============================================================
           Landing PKLP — token-driven (design-system/MASTER.md +
           design-system/pages/landing.md). Light + dark.
           ============================================================ */
        body {
            background: var(--color-bg);
            font-family: var(--font-sans);
            color: var(--color-text);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* ---------- Navbar ---------- */
        .lp-nav {
            position: sticky;
            top: 0;
            z-index: 20;
            background: color-mix(in srgb, var(--color-surface) 88%, transparent);
            backdrop-filter: saturate(140%) blur(10px);
            border-bottom: 1px solid var(--color-border);
        }

        .lp-nav .navbar-brand {
            color: var(--color-text);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lp-nav .nav-link {
            color: var(--color-text-muted);
            font-weight: 500;
        }

        .lp-nav .nav-link:hover,
        .lp-nav .nav-link:focus {
            color: var(--color-primary);
        }

        .lp-icon-btn {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-sm);
            color: var(--color-text);
            background: var(--color-surface);
        }

        /* ---------- Parallax hero (ported from Aceternity Hero Parallax) ---------- */
        .lp-parallax {
            height: 300vh;
            padding-top: 160px;
            position: relative;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .lp-hero-head {
            max-width: 80rem;
            margin: 0 auto;
            padding: 24px 16px 0;
            position: relative;
            z-index: 10;
        }

        .lp-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: var(--radius-full);
            background: var(--color-primary-50);
            color: var(--color-primary-700);
            border: 1px solid var(--color-primary-100);
            font-weight: 600;
            font-size: 13px;
        }

        [data-theme="dark"] .lp-eyebrow {
            background: rgba(74, 73, 176, .2);
            color: var(--color-primary);
            border-color: rgba(74, 73, 176, .45);
        }

        .lp-hero-title {
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -0.02em;
            font-size: clamp(2rem, 6vw, 4.5rem);
            margin: 22px 0 0;
            color: var(--color-text);
        }

        .lp-hero-title .accent {
            color: var(--color-primary);
        }

        .lp-hero-sub {
            max-width: 42rem;
            margin-top: 22px;
            font-size: clamp(1rem, 2.2vw, 1.25rem);
            color: var(--color-text-muted);
            line-height: 1.6;
        }

        .lp-hero-cta {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* the rotating/translating stage driven by scroll */
        .lp-stage {
            will-change: transform, opacity;
        }

        .lp-row {
            display: flex;
            gap: 40px;
            margin-bottom: 40px;
            will-change: transform;
        }

        .lp-row--reverse {
            flex-direction: row-reverse;
        }

        .lp-card {
            position: relative;
            flex-shrink: 0;
            height: 22rem;
            width: 28rem;
            max-width: 85vw;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-e2);
            border: 1px solid var(--color-border);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .lp-card:hover {
            transform: translateY(-16px);
            box-shadow: var(--shadow-e3);
        }

        .lp-card img {
            position: absolute;
            inset: 0;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .lp-card .lp-card-veil {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(26, 26, 77, 0) 35%, rgba(26, 26, 77, .82) 100%);
        }

        .lp-card .lp-card-label {
            position: absolute;
            left: 18px;
            bottom: 16px;
            right: 18px;
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .lp-card .lp-card-label i {
            width: 18px;
            height: 18px;
        }

        /* chart card (mengganti gambar) */
        .lp-chart-card {
            display: flex;
            flex-direction: column;
            gap: 8px;
            background: var(--color-surface);
            padding: 16px 16px 10px;
            text-decoration: none;
        }

        .lp-chart-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .lp-chart-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: .98rem;
            color: var(--color-text);
        }

        .lp-chart-title i {
            width: 18px;
            height: 18px;
            color: var(--color-primary);
            flex-shrink: 0;
        }

        .lp-chart-go {
            width: 18px;
            height: 18px;
            color: var(--color-text-subtle);
            flex-shrink: 0;
            transition: color .2s ease, transform .2s ease;
        }

        .lp-chart-card:hover .lp-chart-go {
            color: var(--color-primary);
            transform: translate(2px, -2px);
        }

        .lp-chart-canvas {
            position: relative;
            flex: 1 1 auto;
            min-height: 0;
        }

        .lp-chart-canvas canvas {
            width: 100% !important;
            height: 100% !important;
        }

        /* ---------- Generic section ---------- */
        .lp-section {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .lp-section-head {
            text-align: center;
            max-width: 44rem;
            margin: 0 auto 40px;
        }

        .lp-section-head h2 {
            font-weight: 700;
            font-size: clamp(1.6rem, 4vw, 2.25rem);
            color: var(--color-text);
            margin: 12px 0 0;
        }

        .lp-section-head p {
            color: var(--color-text-muted);
            margin-top: 12px;
            font-size: 1.05rem;
        }

        .lp-kicker {
            text-transform: uppercase;
            letter-spacing: .08em;
            font-size: .8rem;
            font-weight: 700;
            color: var(--color-primary);
        }

        /* features */
        .lp-features {
            padding: 96px 0;
        }

        .lp-feature {
            height: 100%;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-e1);
            padding: 24px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .lp-feature:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-e2);
        }

        .lp-feature-ico {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--color-primary-50);
            color: var(--color-primary-700);
            margin-bottom: 16px;
        }

        [data-theme="dark"] .lp-feature-ico {
            background: rgba(74, 73, 176, .2);
            color: var(--color-primary);
        }

        .lp-feature h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--color-text);
            margin: 0 0 6px;
        }

        .lp-feature p {
            color: var(--color-text-muted);
            font-size: .95rem;
            margin: 0;
            line-height: 1.55;
        }

        /* stats */
        .lp-stats {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            border-bottom: 1px solid var(--color-border);
            padding: 64px 0;
        }

        .lp-stat {
            text-align: center;
            padding: 12px;
        }

        .lp-stat .num {
            font-family: var(--font-mono);
            font-feature-settings: "tnum";
            font-size: clamp(2rem, 5vw, 2.75rem);
            font-weight: 700;
            color: var(--color-primary);
            line-height: 1;
        }

        .lp-stat .lbl {
            color: var(--color-text-muted);
            font-size: .95rem;
            margin-top: 8px;
        }

        /* closing CTA */
        .lp-cta {
            padding: 96px 0;
        }

        .lp-cta-card {
            max-width: 960px;
            margin: 0 auto;
            text-align: center;
            background: linear-gradient(135deg, var(--color-primary-700), var(--color-primary-600));
            color: #fff;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-e2);
            padding: 56px 24px;
        }

        .lp-cta-card h2 {
            font-weight: 700;
            font-size: clamp(1.6rem, 4vw, 2.25rem);
            margin: 0 0 12px;
        }

        .lp-cta-card p {
            color: rgba(255, 255, 255, .85);
            max-width: 38rem;
            margin: 0 auto 28px;
        }

        /* buttons (reuse ds-btn semantics; .ds-* already in design-tokens.css) */
        .lp-btn-white {
            background: #fff;
            color: var(--color-primary-700);
        }

        .lp-btn-white:hover {
            background: #f1f1fb;
            color: var(--color-primary-700);
        }

        .lp-btn-outline-white {
            background: transparent;
            color: #fff;
            border-color: rgba(255, 255, 255, .6);
        }

        .lp-btn-outline-white:hover {
            background: rgba(255, 255, 255, .12);
            color: #fff;
        }

        /* footer */
        .lp-footer {
            padding: 40px 0;
            color: var(--color-text-muted);
            font-size: .9rem;
            border-top: 1px solid var(--color-border);
        }

        /* reduced motion: kill parallax movement, show static grid */
        @media (prefers-reduced-motion: reduce) {
            .lp-stage {
                transform: none !important;
                opacity: 1 !important;
            }

            .lp-row {
                transform: none !important;
            }
        }

        @media (max-width: 768px) {
            .lp-parallax {
                height: 300vh;
                padding-top: 120px;
            }

            .lp-card {
                height: 16rem;
                width: 20rem;
            }

            .lp-row,
            .lp-row--reverse {
                gap: 20px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- ================= NAVBAR ================= --}}
    <nav class="navbar navbar-expand-lg lp-nav">
        <div class="container">
            <a class="navbar-brand" href="/landing">
                <img src="{{ asset('logo.png') }}" alt="Logo PT. PKLP Marine Offshore" height="40"
                    onerror="this.onerror=null;this.src='https://www.pklp.co.id/wp-content/uploads/2023/11/Logo-PKLP-Besar-1-120x61.png';">
                <span class="d-none d-sm-inline">PKLP Marine Offshore</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#lpNav"
                aria-controls="lpNav" aria-expanded="false" aria-label="Buka menu navigasi">
                <i data-lucide="menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="lpNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="/public-dashboard">Dashboard</a></li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0">
                        <button type="button" class="lp-icon-btn" data-theme-toggle
                            aria-label="Ganti tema terang/gelap">
                            <svg data-theme-icon width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true"></svg>
                        </button>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="/login" class="ds-btn ds-btn--primary">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ================= HERO PARALLAX ================= --}}
    @php
        // Chart live yang sama dgn dashboard publik. Tiap kartu = 1 chart + tautan ke
        // halaman admin terkait (butuh login; bila belum → diarahkan ke /login).
        $chartDefs = [
            ['type' => 'line', 'title' => 'Tren Insiden', 'icon' => 'triangle-alert', 'href' => '/admin/incident-resume', 'labels' => $incidentMonths, 'data' => $incidentTotals, 'opts' => ['label' => 'Total Insiden']],
            ['type' => 'proportion', 'title' => 'Kategori HSSE', 'icon' => 'bar-chart-3', 'href' => '/admin/hsse-statistics', 'labels' => $hsseCategoryLabels, 'data' => $hsseCategoryTotals, 'opts' => []],
            ['type' => 'line', 'title' => 'Tren Man-Hours', 'icon' => 'timer', 'href' => '/admin/man-hours', 'labels' => $manHourMonths, 'data' => $manHourTotals, 'opts' => ['label' => 'Man Hours']],
            ['type' => 'proportion', 'title' => 'Temuan per Tipe', 'icon' => 'search-check', 'href' => '/admin/audit-findings', 'labels' => $findingTypeLabels, 'data' => $findingTypeTotals, 'opts' => []],
            ['type' => 'proportion', 'title' => 'Status Temuan', 'icon' => 'clipboard-check', 'href' => '/admin/audit-findings', 'labels' => $findingStatusLabels, 'data' => $findingStatusTotals, 'opts' => []],
            ['type' => 'proportion', 'title' => 'Management Review', 'icon' => 'file-check-2', 'href' => '/admin/management-reviews', 'labels' => $reviewLabels, 'data' => $reviewTotals, 'opts' => []],
            ['type' => 'proportion', 'title' => 'Management Visit', 'icon' => 'map-pinned', 'href' => '/admin/management-visits', 'labels' => $visitLabels, 'data' => $visitTotals, 'opts' => []],
            ['type' => 'proportion', 'title' => 'Status Sertifikat', 'icon' => 'badge-check', 'href' => '/admin/vessel-certificates', 'labels' => $certificateLabels, 'data' => $certificateTotals, 'opts' => []],
            ['type' => 'proportion', 'title' => 'Status Maintenance', 'icon' => 'wrench', 'href' => '/admin/maintenance-checklists', 'labels' => $maintenanceLabels, 'data' => $maintenanceTotals, 'opts' => []],
        ];

        // Isi dinding parallax (3 baris × 5 = 15) dgn memutar 9 chart; tiap kanvas dpt id unik.
        $cards = [];
        $n = count($chartDefs);
        for ($i = 0; $i < 15; $i++) {
            $d = $chartDefs[$i % $n];
            $d['cid'] = 'lpchart' . $i;
            $cards[] = $d;
        }
        $rows = array_chunk($cards, 5);
    @endphp

    <section class="lp-parallax" id="hero">
        <div class="lp-hero-head">
            <h1 class="lp-hero-title">
                Monitoring <span class="accent">QHSE &amp; Fleet Monitoring</span><br>
                untuk Operasi Marine Offshore
            </h1>
            <p class="lp-hero-sub">
                Satu platform terintegrasi untuk audit, temuan, man-hours, sertifikat kapal,
                maintenance, hingga management review — terpantau real-time, aman, dan terukur.
            </p>
            <div class="lp-hero-cta">
                <a href="/public-dashboard" class="ds-btn ds-btn--primary">
                    <i data-lucide="layout-dashboard" style="width:18px;height:18px"></i> Lihat Dashboard
                </a>
                <a href="/login" class="ds-btn ds-btn--secondary">
                    <i data-lucide="log-in" style="width:18px;height:18px"></i> Masuk Sistem
                </a>
            </div>
        </div>

        <div class="lp-stage" id="lpStage">
            @foreach ($rows as $ri => $row)
                <div class="lp-row {{ $ri === 1 ? 'lp-row--reverse' : '' }}"
                    data-dir="{{ $ri === 1 ? 'reverse' : 'forward' }}">
                    @foreach ($row as $card)
                        <a href="{{ $card['href'] }}" class="lp-card lp-chart-card"
                            aria-label="Buka {{ $card['title'] }} di panel admin">
                            <div class="lp-chart-head">
                                <span class="lp-chart-title"><i data-lucide="{{ $card['icon'] }}"></i>
                                    {{ $card['title'] }}</span>
                                <i data-lucide="arrow-up-right" class="lp-chart-go"></i>
                            </div>
                            <div class="lp-chart-canvas">
                                <canvas id="{{ $card['cid'] }}" role="img" aria-label="Grafik {{ $card['title'] }}"></canvas>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= FITUR ================= --}}
    @php
        $features = [
            ['i' => 'clipboard-check', 't' => 'Audit & Temuan', 'd' => 'Kelola audit internal, checklist, dan temuan dengan status Open/Overdue/Closed yang jelas dan dapat diekspor PDF.'],
            ['i' => 'timer', 't' => 'Man-Hours & HSSE', 'd' => 'Catat jam kerja dan statistik HSSE per lokasi/armada, lengkap dengan tren insiden dan kategori.'],
            ['i' => 'badge-check', 't' => 'Sertifikat Kapal', 'd' => 'Pantau masa berlaku sertifikat — peringatan dini untuk yang akan kedaluwarsa maupun yang sudah expired.'],
            ['i' => 'wrench', 't' => 'Maintenance', 'd' => 'Checklist perawatan dan daily check armada agar kondisi kapal selalu terkontrol dan terdokumentasi.'],
            ['i' => 'file-check-2', 't' => 'Management Review', 'd' => 'Kelola management review & visit, dari perencanaan hingga tindak lanjut, dalam satu alur kerja.'],
            ['i' => 'layout-dashboard', 't' => 'Dashboard Eksekutif', 'd' => 'KPI dan analitik QHSE, audit, dan operasi tersaji ringkas untuk pengambilan keputusan cepat.'],
        ];
    @endphp
    <section class="lp-features" id="fitur">
        <div class="lp-section">
            <div class="lp-section-head">
                <span class="lp-kicker">Modul Terintegrasi</span>
                <h2>Semua aspek QHSE &amp; operasi dalam satu sistem</h2>
                <p>Dirancang untuk kebutuhan monitoring marine offshore — terukur, auditable, dan mudah dipakai.</p>
            </div>
            <div class="row g-4">
                @foreach ($features as $f)
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-feature">
                            <span class="lp-feature-ico"><i data-lucide="{{ $f['i'] }}"></i></span>
                            <h3>{{ $f['t'] }}</h3>
                            <p>{{ $f['d'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= STATISTIK ================= --}}
    <section class="lp-stats" id="statistik">
        <div class="lp-section">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="lp-stat">
                        <div class="num">12</div>
                        <div class="lbl">Modul Monitoring</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="lp-stat">
                        <div class="num">6</div>
                        <div class="lbl">Pilar QHSE</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="lp-stat">
                        <div class="num">24/7</div>
                        <div class="lbl">Pemantauan</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="lp-stat">
                        <div class="num">100%</div>
                        <div class="lbl">Terdokumentasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA PENUTUP ================= --}}
    <section class="lp-cta">
        <div class="lp-section">
            <div class="lp-cta-card">
                <h2>Pantau keselamatan &amp; operasi armada Anda hari ini</h2>
                <p>Mulai dari dashboard eksekutif publik, atau masuk ke sistem untuk mengelola data QHSE secara penuh.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="/public-dashboard" class="ds-btn lp-btn-white">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px"></i> Buka Dashboard
                    </a>
                    <a href="/login" class="ds-btn lp-btn-outline-white">
                        <i data-lucide="log-in" style="width:18px;height:18px"></i> Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="lp-footer">
        <div class="lp-section d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>PT. Pelayaran Karya Lentari Perdana © {{ date('Y') }}</span>
            <span>Sistem Monitoring QHSE &amp; Fleet</span>
        </div>
    </footer>

    {{-- ================= SCRIPTS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // ikon vektor (Lucide) — bukan emoji (MASTER §9)
        window.lucide && lucide.createIcons();
    </script>

    <script>
        /* ============================================================
           Hero Parallax — port dari komponen Aceternity (framer-motion).
           useScroll/useTransform/useSpring → scroll progress + rAF + lerp.
           Hanya transform/opacity (MASTER §6). Mati saat prefers-reduced-motion.
           ============================================================ */
        (function () {
            var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)');
            var parallax = document.getElementById('hero');
            var stage = document.getElementById('lpStage');
            if (!parallax || !stage) return;

            var rows = Array.prototype.slice.call(stage.querySelectorAll('.lp-row'));
            if (prefersReduced.matches) return; // grid statis, tanpa gerak

            var clamp = function (v, a, b) { return Math.min(b, Math.max(a, v)); };
            // map progress 'p' di rentang [i0,i1] → [o0,o1] (input di-clamp dulu)
            var seg = function (p, i0, i1, o0, o1) {
                var t = clamp((p - i0) / (i1 - i0), 0, 1);
                return o0 + (o1 - o0) * t;
            };

            // target & current (untuk smoothing ala spring)
            var T = { tx: 0, txr: 0, rx: 15, rz: 20, ty: -700, op: 0.2 };
            var C = Object.assign({}, T);

            function computeTargets() {
                var rect = parallax.getBoundingClientRect();
                // offset ["start start","end start"]: p=0 saat atas kontainer di atas viewport, p=1 saat bawah kontainer di atas viewport
                var p = clamp(-rect.top / rect.height, 0, 1);
                T.tx = seg(p, 0, 1, 0, 1000);
                T.txr = seg(p, 0, 1, 0, -1000);
                T.rx = seg(p, 0, 0.2, 15, 0);
                T.rz = seg(p, 0, 0.2, 20, 0);
                T.ty = seg(p, 0, 0.2, -700, 500);
                T.op = seg(p, 0, 0.2, 0.2, 1);
            }

            var running = false;
            function frame() {
                var k = 0.1; // faktor smoothing (mendekati spring)
                for (var key in T) { C[key] += (T[key] - C[key]) * k; }

                stage.style.transform =
                    'rotateX(' + C.rx.toFixed(2) + 'deg) rotateZ(' + C.rz.toFixed(2) + 'deg) translateY(' + C.ty.toFixed(1) + 'px)';
                stage.style.opacity = C.op.toFixed(3);

                rows.forEach(function (row) {
                    var x = row.getAttribute('data-dir') === 'reverse' ? C.txr : C.tx;
                    row.style.transform = 'translateX(' + x.toFixed(1) + 'px)';
                });

                // lanjut animasi hanya selama masih ada selisih berarti
                var settled = Math.abs(T.tx - C.tx) < 0.5 && Math.abs(T.ty - C.ty) < 0.5 &&
                    Math.abs(T.rx - C.rx) < 0.05 && Math.abs(T.op - C.op) < 0.005;
                if (settled) { running = false; return; }
                requestAnimationFrame(frame);
            }
            function kick() { if (!running) { running = true; requestAnimationFrame(frame); } }

            function onScroll() { computeTargets(); kick(); }
            computeTargets(); C = Object.assign({}, T); // mulai dari posisi yang benar agar tak "loncat"
            frame();

            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll, { passive: true });
        }());
    </script>

    <script src="{{ asset('js/chart-helpers.js') }}"></script>
    <script>
        /* Render chart pada kartu parallax memakai helper bersama (theme-aware,
           status colors, empty-state, tooltip locale id-ID) — sama spt dashboard publik. */
        (function () {
            var defs = @json($cards);
            defs.forEach(function (c) {
                var opts = c.opts || {};
                if (c.type === 'line') {
                    PKLPCharts.line(c.cid, c.labels, c.data, opts);
                } else {
                    PKLPCharts.proportion(c.cid, c.labels, c.data, opts);
                }
            });
        }());
    </script>

    <script src="{{ asset('js/theme-toggle.js') }}"></script>

</body>

</html>