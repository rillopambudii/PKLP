@echo off
REM Jalankan Laravel dev server (Windows): pakai --no-reload untuk hindari
REM error "Failed to listen on 127.0.0.1:8000 (reason: ?)".
php artisan serve --no-reload
