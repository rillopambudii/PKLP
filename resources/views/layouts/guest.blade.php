<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PKLP Monitoring') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/design-tokens.css') }}" rel="stylesheet">
    {{-- Alpine.js via CDN (komponen dropdown/modal) — tanpa npm/build --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- anti-flash: terapkan tema sebelum paint --}}
    <script>try{if(localStorage.getItem('pklp-theme')==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}</script>

    <style>
        /* Token-driven (design-system/MASTER.md). Light + dark-ready. */
        body {
            background:
                radial-gradient(900px 500px at 100% 0%, var(--color-primary-50), transparent 60%),
                var(--color-bg);
            min-height: 100dvh;
            font-family: var(--font-sans);
            color: var(--color-text);
        }
        /* glow lebih halus & gelap saat dark (hindari "light leak" putih) */
        [data-theme="dark"] body {
            background:
                radial-gradient(900px 500px at 100% 0%, rgba(74,73,176,.18), transparent 60%),
                var(--color-bg);
        }

        .login-wrapper {
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-e3);
        }

        .login-logo {
            width: 140px;
            display: block;
            margin: 0 auto 24px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            display: block;
            min-height: 44px;
            padding: 10px 12px;
            background: var(--color-surface);
            color: var(--color-text);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-sm);
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="text"]::placeholder { color: var(--color-text-subtle); }
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px var(--color-primary-300);
        }

        label { font-weight: 600; margin-bottom: 6px; color: var(--color-text); }
        a { color: var(--color-primary); }
        .text-sm.text-gray-600, .text-gray-600 { color: var(--color-text-muted) !important; }

        .btn-login {
            background: var(--color-primary-600);
            color: var(--color-on-primary);
            border: none;
            border-radius: var(--radius-sm);
            padding: 11px 20px;
            min-height: 44px;
            font-weight: 600;
            transition: background .15s ease, box-shadow .15s ease;
        }
        .btn-login:hover { background: var(--color-primary-700); color: var(--color-on-primary); }
        .btn-login:focus-visible { outline: none; box-shadow: 0 0 0 3px var(--color-primary-300); }

        /* error/success message fallback (komponen Breeze pakai class Tailwind yg tak terkompilasi) */
        .text-red-600, .invalid-feedback { color: var(--color-danger) !important; }
        .text-green-600, .text-sm.text-green-600 { color: var(--color-success) !important; }

        /* tombol toggle tema */
        .theme-fab {
            position: fixed; top: 16px; right: 16px; z-index: 50;
            width: 44px; height: 44px; display: inline-flex; align-items: center; justify-content: center;
            background: var(--color-surface); color: var(--color-text);
            border: 1px solid var(--color-border); border-radius: var(--radius-sm);
            box-shadow: var(--shadow-e1); cursor: pointer;
        }
    </style>
</head>

<body>
    <button type="button" class="theme-fab" data-theme-toggle>
        <svg data-theme-icon width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>
    </button>

    <div class="login-wrapper">
        <div class="login-card">
            <img src="{{ asset('logo.png') }}" class="login-logo" alt="PKLP Logo">

            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('js/theme-toggle.js') }}"></script>
</body>
</html>