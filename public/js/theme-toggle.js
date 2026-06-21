/* ============================================================
   PKLP — Theme Toggle (Fase 3)
   Dark/Light, disimpan di localStorage (key: 'pklp-theme').
   Mengeset [data-theme="dark"] di <html>. Token CSS yang menangani warna.
   - Otomatis menyuntik tombol toggle ke navbar AdminLTE (.navbar-nav.ml-auto).
   - Halaman lain bisa sediakan elemen [data-theme-toggle] sendiri.
   - window.PKLPTheme.toggle()/apply()/current() tersedia global.
   ============================================================ */
(function () {
    'use strict';

    var KEY = 'pklp-theme';
    var root = document.documentElement;

    var MOON = '<path d="M21 12.8A9 9 0 1111.2 3a7 7 0 109.8 9.8z"/>';
    var SUN  = '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>';

    function read() {
        try { return localStorage.getItem(KEY) === 'dark' ? 'dark' : 'light'; }
        catch (e) { return 'light'; }
    }
    function current() { return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light'; }

    // Terapkan secepatnya (mengurangi flash di halaman yang memuat script ini di <head>).
    if (read() === 'dark') { root.setAttribute('data-theme', 'dark'); }

    function paintButtons(theme) {
        var dark = theme === 'dark';
        document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
            btn.setAttribute('aria-pressed', dark ? 'true' : 'false');
            btn.setAttribute('aria-label', dark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap');
            btn.setAttribute('title', dark ? 'Mode terang' : 'Mode gelap');
            var icon = btn.querySelector('[data-theme-icon]');
            if (icon) { icon.innerHTML = dark ? SUN : MOON; }
            var label = btn.querySelector('[data-theme-label]');
            if (label) { label.textContent = dark ? 'Light' : 'Dark'; }
        });
    }

    function apply(theme) {
        if (theme === 'dark') { root.setAttribute('data-theme', 'dark'); }
        else { root.removeAttribute('data-theme'); }
        paintButtons(theme);
        // beri tahu komponen lain (mis. charts) agar menyesuaikan warna
        try { window.dispatchEvent(new CustomEvent('pklp:themechange', { detail: { theme: theme } })); }
        catch (e) {}
    }

    function toggle() {
        var next = current() === 'dark' ? 'light' : 'dark';
        try { localStorage.setItem(KEY, next); } catch (e) {}
        apply(next);
    }

    window.PKLPTheme = { toggle: toggle, apply: apply, current: current };

    function svgIcon() {
        return '<svg data-theme-icon width="18" height="18" viewBox="0 0 24 24" fill="none" ' +
               'stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>';
    }

    // Suntik tombol ke navbar AdminLTE bila belum ada toggle di halaman.
    function injectAdminButton() {
        if (document.querySelector('[data-theme-toggle]')) return;
        var nav = document.querySelector('.main-header .navbar-nav.ml-auto')
               || document.querySelector('.main-header ul.navbar-nav:last-of-type');
        if (!nav) return;
        var li = document.createElement('li');
        li.className = 'nav-item';
        var a = document.createElement('a');
        a.href = '#';
        a.className = 'nav-link theme-toggle-link';
        a.setAttribute('data-theme-toggle', '');
        a.setAttribute('role', 'button');
        a.innerHTML = svgIcon();
        li.appendChild(a);
        nav.appendChild(li);
    }

    function wireButtons() {
        document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
            if (btn.__themeWired) return;
            btn.__themeWired = true;
            btn.addEventListener('click', function (e) { e.preventDefault(); toggle(); });
        });
    }

    function init() {
        injectAdminButton();
        wireButtons();
        apply(current());
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
