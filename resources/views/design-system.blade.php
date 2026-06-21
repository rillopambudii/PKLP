<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Design System — PKLP Monitoring</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {{-- SUMBER TOKEN: berubah saat MASTER.md / design-tokens.css berubah --}}
    <link rel="stylesheet" href="{{ asset('css/design-tokens.css') }}">
    <style>
        .wrap{ max-width:1100px; margin:0 auto; padding:24px 20px 80px; }
        .topbar{
            position:sticky; top:0; z-index:20; background:var(--color-surface);
            border-bottom:1px solid var(--color-border); box-shadow:var(--shadow-e1);
        }
        .topbar .wrap{ padding:14px 20px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        section{ margin-top:40px; }
        .sec-head{ display:flex; align-items:baseline; gap:10px; margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid var(--color-border); }
        .sec-head small{ color:var(--color-text-subtle); font-size:.78rem; }
        .grid{ display:grid; gap:16px; }
        .cols-2{ grid-template-columns:repeat(2,1fr); }
        .cols-3{ grid-template-columns:repeat(3,1fr); }
        .cols-auto{ grid-template-columns:repeat(auto-fill,minmax(150px,1fr)); }
        @media(max-width:680px){ .cols-2,.cols-3{ grid-template-columns:1fr; } }

        /* color swatch */
        .swatch{ border:1px solid var(--color-border); border-radius:var(--radius-md); overflow:hidden; background:var(--color-surface); }
        .swatch .chip{ height:64px; }
        .swatch .meta{ padding:8px 10px; }
        .swatch .name{ font-size:.78rem; font-weight:600; }
        .swatch .hex{ font-family:var(--font-mono); font-size:.72rem; color:var(--color-text-muted); }

        .row{ display:flex; flex-wrap:wrap; gap:12px; align-items:center; }
        .stack{ display:flex; flex-direction:column; gap:6px; }

        /* radius / elevation demo */
        .demo-box{ height:72px; background:var(--color-primary-100); border:1px solid var(--color-border); display:flex; align-items:center; justify-content:center; color:var(--color-primary-700); font-size:.75rem; font-weight:600; }
        .elev-box{ height:72px; background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; font-size:.75rem; color:var(--color-text-muted); }

        /* spacing demo */
        .space-bar{ background:var(--color-primary-400); height:14px; border-radius:3px; }

        .theme-toggle{ display:inline-flex; align-items:center; gap:8px; }
        .note{ font-size:.82rem; color:var(--color-text-muted); background:var(--color-surface-2); border:1px solid var(--color-border); border-left:3px solid var(--color-primary); border-radius:var(--radius-sm); padding:10px 14px; }
        .pill{ font-size:.7rem; font-family:var(--font-mono); background:var(--color-surface-2); border:1px solid var(--color-border); padding:1px 7px; border-radius:var(--radius-full); color:var(--color-text-muted); }
    </style>
</head>
<body>

<div class="topbar">
    <div class="wrap">
        <div class="row" style="gap:12px;">
            <img src="{{ asset('logo.png') }}" alt="Logo PKLP" style="height:34px;">
            <div class="stack" style="gap:0;">
                <strong>PKLP Design System</strong>
                <span class="ds-caption">Living preview dari <span class="ds-mono">design-system/MASTER.md</span></span>
            </div>
        </div>
        <button class="ds-btn ds-btn--secondary theme-toggle" id="themeToggle" type="button" aria-label="Ganti tema">
            <svg id="themeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>
            <span id="themeText">Dark</span>
        </button>
    </div>
</div>

<div class="wrap">

    <div class="note" style="margin-top:24px;">
        Halaman ini membaca token dari <span class="ds-mono">public/css/design-tokens.css</span> (bentuk eksekusi MASTER.md).
        Ubah token di sana → semua contoh di bawah otomatis menyesuaikan, termasuk label hex (dibaca via JS).
        Klik <strong>Dark</strong> untuk menguji kontras kedua mode.
    </div>

    {{-- ============ BRAND ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Brand</h2><small>MASTER §1</small></div>
        <div class="grid cols-3">
            <div class="ds-card stack">
                <span class="ds-label">Marine Blue — Primary</span>
                <div style="height:48px;border-radius:var(--radius-sm);background:var(--color-primary-600);"></div>
                <span class="hex ds-mono" data-var="--color-primary-600"></span>
            </div>
            <div class="ds-card stack">
                <span class="ds-label">Brand Red — Accent</span>
                <div style="height:48px;border-radius:var(--radius-sm);background:var(--color-accent);"></div>
                <span class="hex ds-mono" data-var="--color-accent"></span>
            </div>
            <div class="ds-card stack">
                <span class="ds-label">Logo</span>
                <img src="{{ asset('logo.png') }}" alt="Logo PT. PKLP Marine Offshore" style="height:48px;object-fit:contain;align-self:flex-start;">
                <span class="ds-caption">PT. PKLP Marine Offshore</span>
            </div>
        </div>
    </section>

    {{-- ============ COLORS ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Warna</h2><small>MASTER §2 — token semantik</small></div>

        <h3 class="ds-h3" style="margin-bottom:10px;">Skala Primary</h3>
        <div class="grid cols-auto">
            @foreach(['50','100','200','300','400','500','600','700','800','900'] as $s)
                <div class="swatch">
                    <div class="chip" style="background:var(--color-primary-{{ $s }});"></div>
                    <div class="meta"><div class="name">primary-{{ $s }}</div><div class="hex" data-var="--color-primary-{{ $s }}"></div></div>
                </div>
            @endforeach
        </div>

        <h3 class="ds-h3" style="margin:20px 0 10px;">Status</h3>
        <div class="grid cols-auto">
            @foreach(['success'=>'Success','warning'=>'Warning','danger'=>'Danger','info'=>'Info','accent'=>'Accent'] as $k=>$label)
                <div class="swatch">
                    <div class="chip" style="background:var(--color-{{ $k }});"></div>
                    <div class="meta"><div class="name">{{ $label }}</div><div class="hex" data-var="--color-{{ $k }}"></div></div>
                </div>
            @endforeach
        </div>

        <h3 class="ds-h3" style="margin:20px 0 10px;">Surface &amp; Text</h3>
        <div class="grid cols-auto">
            @foreach(['bg'=>'Background','surface'=>'Surface','surface-2'=>'Surface-2','border'=>'Border','text'=>'Text','text-muted'=>'Text muted','text-subtle'=>'Text subtle'] as $k=>$label)
                <div class="swatch">
                    <div class="chip" style="background:var(--color-{{ $k }});"></div>
                    <div class="meta"><div class="name">{{ $label }}</div><div class="hex" data-var="--color-{{ $k }}"></div></div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ TYPOGRAPHY ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Tipografi</h2><small>MASTER §3 — Inter + JetBrains Mono</small></div>
        <div class="ds-card stack" style="gap:14px;">
            <div class="ds-h1">Display / H1 — 30px Bold</div>
            <div class="ds-h2">Heading H2 — 24px Semibold</div>
            <div class="ds-h3">Card Title H3 — 18px Semibold</div>
            <div class="ds-body">Body 16px Regular — Monitoring QHSE PKLP: audit, temuan, man-hours, sertifikat, dan maintenance dalam satu sistem.</div>
            <div class="ds-label">Label / Body-sm — 14px Medium</div>
            <div class="ds-caption">Caption — 12px Medium (teks sekunder)</div>
            <div class="ds-mono ds-body">Angka tabular: 1.234.567 · 98,6% · 2026-06-16</div>
        </div>
    </section>

    {{-- ============ BUTTONS ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Tombol</h2><small>MASTER §5 — min 44px, 1 primary/layar</small></div>
        <div class="ds-card stack" style="gap:18px;">
            <div class="row">
                <button class="ds-btn ds-btn--primary" type="button">Primary</button>
                <button class="ds-btn ds-btn--secondary" type="button">Secondary</button>
                <button class="ds-btn ds-btn--danger" type="button">Hapus</button>
                <button class="ds-btn ds-btn--ghost" type="button">Ghost</button>
                <button class="ds-btn ds-btn--primary" type="button" disabled>Disabled</button>
            </div>
            <span class="ds-caption">Hover / focus (Tab) / active punya state berbeda. Disabled: opacity .5 + cursor-not-allowed.</span>
        </div>
    </section>

    {{-- ============ BADGES ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Badge Status</h2><small>MASTER §5 — warna + teks</small></div>
        <div class="ds-card row" style="gap:10px;">
            <span class="ds-badge ds-badge--warning">Open</span>
            <span class="ds-badge ds-badge--danger">Overdue</span>
            <span class="ds-badge ds-badge--success">Closed</span>
            <span class="ds-badge ds-badge--success">Valid</span>
            <span class="ds-badge ds-badge--danger">Expired</span>
            <span class="ds-badge ds-badge--info">Pending</span>
        </div>
    </section>

    {{-- ============ FORM ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Form</h2><small>MASTER §5 — label terlihat, error di bawah field</small></div>
        <div class="ds-card grid cols-2">
            <div class="ds-field">
                <label class="ds-label" for="f1">Nama Audit <span class="ds-req">*</span></label>
                <input class="ds-input" id="f1" type="text" placeholder="mis. Audit Internal Q2">
                <span class="ds-help">Helper text persisten untuk input kompleks.</span>
            </div>
            <div class="ds-field">
                <label class="ds-label" for="f2">Target Date <span class="ds-req">*</span></label>
                <input class="ds-input ds-input--error" id="f2" type="date" value="2026-06-01">
                <span class="ds-error" role="alert">Target date tidak boleh sebelum hari ini.</span>
            </div>
        </div>
    </section>

    {{-- ============ CARD / KPI ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Kartu &amp; KPI</h2><small>MASTER §4–§5</small></div>
        <div class="grid cols-3">
            <div class="ds-card stack">
                <span class="ds-caption">Total Audit</span>
                <span class="ds-h1 ds-mono" style="color:var(--color-primary);">128</span>
                <span class="ds-badge ds-badge--success">+12 bln ini</span>
            </div>
            <div class="ds-card stack">
                <span class="ds-caption">Open Finding</span>
                <span class="ds-h1 ds-mono" style="color:var(--color-warning);">34</span>
                <span class="ds-badge ds-badge--warning">Perlu tindak lanjut</span>
            </div>
            <div class="ds-card stack">
                <span class="ds-caption">Overdue Finding</span>
                <span class="ds-h1 ds-mono" style="color:var(--color-danger);">7</span>
                <span class="ds-badge ds-badge--danger">Lewat target</span>
            </div>
        </div>
    </section>

    {{-- ============ TABLE ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Tabel</h2><small>MASTER §5 — angka rata kanan, mono</small></div>
        <div class="ds-card" style="padding:0;overflow:hidden;">
            <table class="ds-table">
                <thead><tr><th>Bulan</th><th>Tahun</th><th class="ds-num">Total Man Hours</th><th>Status</th></tr></thead>
                <tbody>
                    <tr><td>Januari</td><td>2026</td><td class="ds-num">128.400</td><td><span class="ds-badge ds-badge--success">Closed</span></td></tr>
                    <tr><td>Februari</td><td>2026</td><td class="ds-num">96.250</td><td><span class="ds-badge ds-badge--warning">Open</span></td></tr>
                    <tr><td>Maret</td><td>2026</td><td class="ds-num">142.910</td><td><span class="ds-badge ds-badge--info">Pending</span></td></tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- ============ RADIUS & ELEVATION ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Radius &amp; Elevation</h2><small>MASTER §4</small></div>
        <div class="grid cols-2">
            <div class="ds-card">
                <h3 class="ds-h3" style="margin-bottom:12px;">Radius</h3>
                <div class="grid cols-3">
                    <div class="demo-box" style="border-radius:var(--radius-sm);">sm 6px</div>
                    <div class="demo-box" style="border-radius:var(--radius-md);">md 10px</div>
                    <div class="demo-box" style="border-radius:var(--radius-lg);">lg 16px</div>
                </div>
            </div>
            <div class="ds-card">
                <h3 class="ds-h3" style="margin-bottom:12px;">Elevation</h3>
                <div class="grid cols-3">
                    <div class="elev-box" style="box-shadow:var(--shadow-e1);">e1</div>
                    <div class="elev-box" style="box-shadow:var(--shadow-e2);">e2</div>
                    <div class="elev-box" style="box-shadow:var(--shadow-e3);">e3</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ SPACING ============ --}}
    <section>
        <div class="sec-head"><h2 class="ds-h2">Spacing</h2><small>MASTER §4 — skala 4/8</small></div>
        <div class="ds-card stack" style="gap:10px;">
            @foreach(['1'=>'4px','2'=>'8px','3'=>'12px','4'=>'16px','6'=>'24px','8'=>'32px','12'=>'48px','16'=>'64px'] as $k=>$v)
                <div class="row" style="gap:12px;">
                    <span class="pill" style="min-width:64px;">space-{{ $k }}</span>
                    <div class="space-bar" style="width:var(--space-{{ $k }});"></div>
                    <span class="ds-caption">{{ $v }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <p class="ds-caption" style="margin-top:48px;text-align:center;">
        PKLP Design System · dihasilkan dari <span class="ds-mono">design-system/MASTER.md</span>
    </p>
</div>

<script>
    // ---- Label hex auto-sync dari token (ikut berubah saat token diubah) ----
    function refreshHex(){
        var cs = getComputedStyle(document.documentElement);
        document.querySelectorAll('[data-var]').forEach(function(el){
            var v = cs.getPropertyValue(el.getAttribute('data-var')).trim();
            if(v) el.textContent = v.toUpperCase();
        });
    }

    // ---- Dark / Light toggle (persist) ----
    var root = document.documentElement;
    var btnIcon = document.getElementById('themeIcon');
    var btnText = document.getElementById('themeText');
    var SUN = '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>';
    var MOON = '<path d="M21 12.8A9 9 0 1111.2 3a7 7 0 109.8 9.8z"/>';
    function applyTheme(t){
        if(t === 'dark'){ root.setAttribute('data-theme','dark'); btnIcon.innerHTML=SUN; btnText.textContent='Light'; }
        else{ root.removeAttribute('data-theme'); btnIcon.innerHTML=MOON; btnText.textContent='Dark'; }
        refreshHex();
    }
    applyTheme(localStorage.getItem('pklp-theme') || 'light');
    document.getElementById('themeToggle').addEventListener('click', function(){
        var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        localStorage.setItem('pklp-theme', next);
        applyTheme(next);
    });
</script>
</body>
</html>
