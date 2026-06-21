/*
 * PKLP — Tabel admin → tampilan KARTU di layar HP.
 *
 * Membaca judul kolom dari <thead>, lalu memasang atribut data-label ke setiap
 * <td>. CSS (.pklp-cardize di adminlte-theme.css) yang mengubah tampilan jadi
 * kartu "Label : Nilai" saat layar kecil. Tidak perlu mengedit file Blade.
 *
 * Tabel kompleks (jumlah sel tidak sama dengan jumlah kolom header, mis. karena
 * colspan) otomatis dilewati — tetap pakai scroll horizontal.
 */
(function () {
    'use strict';

    function labelize(table) {
        if (table.dataset.pklpCardize) return;

        var ths = table.querySelectorAll('thead > tr > th');
        if (!ths.length) return;

        var labels = Array.prototype.map.call(ths, function (th) {
            return th.textContent.replace(/\s+/g, ' ').trim();
        });

        var rows = table.querySelectorAll('tbody > tr');
        if (!rows.length) return;

        // Lewati tabel yang struktur selnya tidak konsisten dengan header.
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].children.length !== labels.length) return;
        }

        rows.forEach(function (tr) {
            Array.prototype.forEach.call(tr.children, function (td, idx) {
                if (labels[idx]) {
                    td.setAttribute('data-label', labels[idx]);
                }
            });
        });

        table.classList.add('pklp-cardize');
        table.dataset.pklpCardize = '1';
    }

    function run() {
        document.querySelectorAll('.content table.table').forEach(labelize);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
})();
