<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Cairo", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top right, rgba(187, 62, 3, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(36, 123, 160, 0.16), transparent 26%),
                linear-gradient(135deg, #f8f4ec 0%, #efe6d7 100%);
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
        }

        .brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, #bb3e03, #ee9b00);
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            box-shadow: 0 14px 30px rgba(187, 62, 3, 0.22);
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
            border: 1px solid rgba(21, 32, 51, 0.1);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            min-height: 52px;
            padding: 0 16px;
            font: inherit;
            color: inherit;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: rgba(187, 62, 3, 0.35);
            box-shadow: 0 0 0 4px rgba(187, 62, 3, 0.1);
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
            color: #13653e;
        }

        .alert-error {
            background: var(--danger-soft);
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
            background: linear-gradient(135deg, var(--accent), #ee9b00);
            box-shadow: 0 18px 35px rgba(187, 62, 3, 0.2);
            cursor: pointer;
        }

        .button:hover {
            background: linear-gradient(135deg, var(--accent-dark), #d98a00);
        }

        .links {
            margin-top: 20px;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
        }

        .links a {
            color: var(--accent-dark);
            text-decoration: none;
            font-weight: 700;
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
            color: #a52834;
            font-size: 13px;
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
        }
    </style>
    @yield('head')
</head>

<body>
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
</body>

</html>
