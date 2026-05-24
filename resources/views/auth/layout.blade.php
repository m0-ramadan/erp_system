<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <script>
        (function() {
            const templateName = 'vertical-menu-template-no-customizer';
            let style = localStorage.getItem('templateCustomizer-' + templateName + '--Style');
            if (!style || style === 'system') {
                style = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.className = style + '-style';
        })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ERP')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5f1e8;
            --panel: rgba(255, 255, 255, 0.86);
            --line: rgba(22, 35, 52, 0.08);
            --text: #152033;
            --muted: #667085;
            --accent: #bb3e03;
            --accent-dark: #8d2e03;
            --accent-soft: rgba(187, 62, 3, 0.12);
            --success-soft: rgba(25, 135, 84, 0.12);
            --danger-soft: rgba(220, 53, 69, 0.12);
        }

        .light-style {
            --bg: #faf6f0;
            --panel: rgba(255, 255, 255, 0.88);
            --line: rgba(44, 48, 56, 0.08);
            --text: #2c3038;
            --muted: #7a828a;
            --accent: #f19022;
            --accent-dark: #d8760e;
            --accent-soft: rgba(241, 144, 34, 0.12);
            --success-soft: rgba(40, 199, 111, 0.12);
            --danger-soft: rgba(234, 84, 85, 0.12);
            --accent-gradient: linear-gradient(135deg, #f19022, #fbc875);
            --accent-shadow: rgba(241, 144, 34, 0.2);
        }

        .dark-style {
            --bg: #152241;
            --panel: rgba(25, 38, 66, 0.86);
            --line: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --muted: rgba(255, 255, 255, 0.7);
            --accent: #ee9b00;
            --accent-dark: #d98a00;
            --accent-soft: rgba(238, 155, 0, 0.15);
            --success-soft: rgba(25, 135, 84, 0.15);
            --danger-soft: rgba(220, 53, 69, 0.15);
            --accent-gradient: linear-gradient(135deg, #ee9b00, #bb3e03);
            --accent-shadow: rgba(238, 155, 0, 0.25);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Cairo", sans-serif;
            color: var(--text);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .light-style body {
            background:
                radial-gradient(circle at top right, rgba(241, 144, 34, 0.15), transparent 28%),
                radial-gradient(circle at bottom left, rgba(36, 123, 160, 0.1), transparent 26%),
                linear-gradient(135deg, #fdfbf7 0%, #faf6f0 100%);
        }

        .dark-style body {
            background:
                radial-gradient(circle at top right, rgba(187, 62, 3, 0.15), transparent 28%),
                radial-gradient(circle at bottom left, rgba(36, 123, 160, 0.12), transparent 26%),
                linear-gradient(135deg, #152241 0%, #0c1426 100%);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .auth-card {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .auth-panel {
            width: 100%;
            max-width: 520px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 28px;
            backdrop-filter: blur(14px);
            box-shadow: 0 24px 60px rgba(21, 32, 51, 0.12);
            padding: 32px;
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: var(--accent-gradient);
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            box-shadow: 0 14px 30px var(--accent-shadow);
        }

        h1 {
            margin: 18px 0 8px;
            font-size: 30px;
            line-height: 1.2;
        }

        .subtitle {
            margin: 0 0 26px;
            color: var(--muted);
            line-height: 1.8;
            transition: color 0.3s ease;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        input,
        select {
            width: 100%;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            min-height: 52px;
            padding: 0 16px;
            font: inherit;
            color: inherit;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease, background-color .2s ease, color .2s ease;
        }

        .light-style input, .light-style select {
            color: #2c3038;
        }

        .dark-style input,
        .dark-style select {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-soft);
            transform: translateY(-1px);
        }

        .hint {
            margin-top: 8px;
            color: var(--muted);
            font-size: 13px;
        }

        .alert {
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-success {
            background: var(--success-soft);
            color: #28c76f;
        }
        .light-style .alert-success {
            color: #13653e;
        }

        .alert-error {
            background: var(--danger-soft);
            color: #ea5455;
        }
        .light-style .alert-error {
            color: #a52834;
        }

        .button {
            width: 100%;
            min-height: 52px;
            border: 0;
            border-radius: 16px;
            font: inherit;
            font-weight: 800;
            color: #fff;
            background: var(--accent-gradient);
            box-shadow: 0 18px 35px var(--accent-shadow);
            cursor: pointer;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .button:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }
        .button:active {
            transform: translateY(1px);
        }

        .links {
            margin-top: 20px;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
        }

        .links a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }
        .links a:hover {
            color: var(--accent-dark);
            text-decoration: underline;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 56px;
            display: flex;
            align-items: flex-end;
            background:
                linear-gradient(160deg, rgba(21, 32, 51, 0.92), rgba(35, 55, 86, 0.9)),
                linear-gradient(135deg, #1f3552, #7c2d12);
            color: #fff;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
        }

        .hero::before {
            width: 320px;
            height: 320px;
            top: -120px;
            left: -60px;
        }

        .hero::after {
            width: 220px;
            height: 220px;
            bottom: -80px;
            right: -40px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 560px;
            bottom: 12rem;
        }

        .hero-kicker {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .hero h2 {
            margin: 0 0 14px;
            font-size: 42px;
            line-height: 1.15;
        }

        .hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            line-height: 1.9;
            font-size: 17px;
        }

        .hero ul {
            margin: 26px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 12px;
        }

        .hero li {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .errors {
            margin: 10px 0 0;
            padding: 0;
            list-style: none;
            color: #ea5455;
            font-size: 13px;
        }
        .light-style .errors {
            color: #a52834;
        }

        /* Floating glassmorphic theme switch button */
        .theme-toggle-btn {
            position: fixed;
            top: 24px;
            left: 24px;
            z-index: 1000;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid var(--line);
            background: var(--panel);
            color: var(--text);
            display: grid;
            place-items: center;
            cursor: pointer;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }
        .theme-toggle-btn:hover {
            transform: scale(1.08) rotate(8deg);
        }
        .theme-toggle-btn:active {
            transform: scale(0.95);
        }
        .theme-toggle-svg {
            width: 22px;
            height: 22px;
        }

        @media (max-width: 980px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-card {
                padding: 24px 18px 32px;
            }

            .hero {
                display: none;
            }

            .hero h2 {
                font-size: 30px;
            }

            .auth-panel {
                max-width: 560px;
            }
            .theme-toggle-btn {
                top: 16px;
                left: 16px;
            }
        }
    </style>
    @yield('head')
</head>

<body>
    <button class="theme-toggle-btn" onclick="toggleThemeMode()" aria-label="تبديل المظهر"></button>
    <div class="auth-shell">
        <section class="auth-card">
            <div class="auth-panel">
                @yield('content')
            </div>
        </section>
        <aside class="hero">
            <div class="hero-content">
                <span class="hero-kicker">Quotation Workflow ERP</span>
                <h2>دخول منظم وآمن لفريق العمل</h2>
                <p>الوصول للنظام يتم بحسابات مُدارة، وليس باختيار المستخدم لصلاحيته أو وظيفته من صفحة عامة.</p>
                <ul>
                    <li>تسجيل الدخول يوجّهك مباشرة إلى لوحة الإدارة بعد التحقق من الحساب.</li>
                    <li>إنشاء الحساب العام مخصص لأول مسؤول فقط لإعداد النظام لأول مرة.</li>
                    <li>باقي المستخدمين يتم إنشاؤهم وإدارة أدوارهم من داخل لوحة الإدارة.</li>
                </ul>
            </div>
        </aside>
    </div>

    <script>
        function toggleThemeMode() {
            const templateName = 'vertical-menu-template-no-customizer';
            const currentStyle = document.documentElement.classList.contains('dark-style') ? 'dark' : 'light';
            const newStyle = currentStyle === 'dark' ? 'light' : 'dark';
            
            localStorage.setItem('templateCustomizer-' + templateName + '--Style', newStyle);
            document.documentElement.className = newStyle + '-style';
            
            updateToggleIcon(newStyle);
        }
        
        function updateToggleIcon(style) {
            const btn = document.querySelector('.theme-toggle-btn');
            if (!btn) return;
            if (style === 'dark') {
                btn.innerHTML = `<svg class="theme-toggle-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="5"></circle>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path>
                </svg>`;
            } else {
                btn.innerHTML = `<svg class="theme-toggle-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>`;
            }
        }
        
        // Initial setup
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.documentElement.classList.contains('dark-style') ? 'dark' : 'light';
            updateToggleIcon(style);
            
            // Listen to real-time OS preference changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                const templateName = 'vertical-menu-template-no-customizer';
                const savedStyle = localStorage.getItem('templateCustomizer-' + templateName + '--Style');
                if (!savedStyle || savedStyle === 'system') {
                    const style = e.matches ? 'dark' : 'light';
                    document.documentElement.className = style + '-style';
                    updateToggleIcon(style);
                }
            });
        });
    </script>
</body>

</html>
