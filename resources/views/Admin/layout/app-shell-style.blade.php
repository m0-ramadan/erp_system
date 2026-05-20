<style>
    :root {
        --app-bg: #f4f7fb;
        --app-surface: rgba(255, 255, 255, 0.92);
        --app-surface-strong: #ffffff;
        --app-line: rgba(19, 33, 68, 0.08);
        --app-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        --app-nav-height: 86px;
        --app-primary: #5f63f2;
        --app-primary-2: #0ea5e9;
        --app-accent: #f97316;
        --app-text: #172033;
        --app-muted: #6b7280;
    }

    html,
    body {
        min-height: 100%;
        /* background:
            radial-gradient(circle at top right, rgba(14, 165, 233, 0.12), transparent 24%),
            radial-gradient(circle at bottom left, rgba(249, 115, 22, 0.1), transparent 22%),
            linear-gradient(180deg, #46566b 0%, #2a323b 100%); */
        /* color: var(--app-text); */
    }

    body {
        overscroll-behavior-y: none;
    }

    .layout-wrapper {
        min-height: 100vh;
        background: transparent;
    }

    .layout-page {
        min-height: 100vh;
    }

    .content-wrapper {
        min-height: calc(100vh - 64px);
        padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 18px);
    }

    .app-shell {
        position: relative;
    }

    .app-shell::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 85% 10%, rgba(95, 99, 242, 0.07), transparent 25%),
            radial-gradient(circle at 12% 88%, rgba(14, 165, 233, 0.08), transparent 18%);
        z-index: 0;
    }

    .layout-container,
    .layout-page,
    .content-wrapper {
        position: relative;
        z-index: 1;
    }

    .layout-navbar {
        margin-top: 14px;
        border: 1px solid rgba(255, 255, 255, 0.56);
        backdrop-filter: blur(18px);
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        background: #342550bd !important;
    }

    .content-footer {
        background: transparent !important;
        border-top: 0 !important;
        color: var(--app-muted);
        padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 6px);
    }

    .app-splash {
        position: fixed;
        inset: 0;
        z-index: 1085;
        display: grid;
        place-items: center;
        background:
            radial-gradient(circle at top right, rgba(14, 165, 233, 0.2), transparent 28%),
            linear-gradient(145deg, #152241 0%, #253b6c 55%, #0f766e 100%);
        color: #fff;
        transition: opacity .35s ease, visibility .35s ease;
    }

    .app-splash.is-hidden {
        opacity: 0;
        visibility: hidden;
    }

    .app-splash-card {
        text-align: center;
        padding: 28px 30px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        box-shadow: 0 22px 60px rgba(0, 0, 0, 0.18);
    }

    .app-splash-logo {
        width: 86px;
        height: 86px;
        margin: 0 auto 18px;
        border-radius: 26px;
        display: grid;
        place-items: center;
        font-size: 34px;
        font-weight: 900;
        background: linear-gradient(135deg, #5f63f2, #0ea5e9);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12);
    }

    .app-splash h2 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 800;
    }

    .app-splash p {
        margin: 0;
        color: rgba(255, 255, 255, 0.78);
    }

    .app-loader {
        width: 58px;
        height: 58px;
        margin: 22px auto 0;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.18);
        border-top-color: #fff;
        animation: app-spin .85s linear infinite;
    }

    .app-page-loader {
        position: fixed;
        inset: auto 20px calc(env(safe-area-inset-bottom, 0px) + 18px) 20px;
        z-index: 1070;
        display: none;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 18px;
        color: #fff;
        background: rgba(21, 34, 65, 0.92);
        box-shadow: var(--app-shadow);
        backdrop-filter: blur(10px);
    }

    .app-page-loader.is-visible {
        display: flex;
    }

    .app-page-loader .dot {
        width: 12px;
        height: 12px;
        border-radius: 999px;
        background: #5f63f2;
        box-shadow: 18px 0 0 #0ea5e9, 36px 0 0 #f97316;
        animation: app-pulse 1s infinite ease-in-out;
    }

    .app-install-banner {
        position: fixed;
        inset-inline: 14px;
        inset-block-end: calc(env(safe-area-inset-bottom, 0px) + var(--app-nav-height) + 8px);
        z-index: 1069;
        display: none;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid var(--app-line);
        box-shadow: var(--app-shadow);
    }

    .app-install-banner.is-visible {
        display: flex;
    }

    .app-install-banner .meta {
        min-width: 0;
    }

    .app-install-banner strong {
        display: block;
        font-size: 14px;
    }

    .app-install-banner span {
        display: block;
        font-size: 12px;
        color: var(--app-muted);
    }

    .app-install-banner .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mobile-bottom-nav {
        position: fixed;
        inset-inline: 10px;
        inset-block-end: calc(env(safe-area-inset-bottom, 0px) + 10px);
        z-index: 1068;
        display: none;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 10px;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.65);
        background: rgba(255, 255, 255, 0.86);
        backdrop-filter: blur(18px);
        box-shadow: 0 22px 42px rgba(15, 23, 42, 0.16);
    }

    .mobile-bottom-nav__item {
        flex: 1;
        min-width: 0;
        text-decoration: none;
        color: var(--app-muted);
        display: grid;
        place-items: center;
        gap: 4px;
        border-radius: 18px;
        padding: 10px 6px 8px;
        transition: transform .2s ease, background-color .2s ease, color .2s ease;
    }

    .mobile-bottom-nav__item i {
        font-size: 22px;
        line-height: 1;
    }

    .mobile-bottom-nav__item span {
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .mobile-bottom-nav__item.is-active {
        color: #fff;
        background: linear-gradient(135deg, var(--app-primary), var(--app-primary-2));
        box-shadow: 0 12px 24px rgba(95, 99, 242, 0.22);
    }

    .mobile-bottom-nav__item:active {
        transform: translateY(1px) scale(0.98);
    }

    .mobile-safe-bottom {
        display: none;
    }

    .app-file-shell {
        display: grid;
        gap: 10px;
    }

    .app-file-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        min-height: 54px;
        padding: 12px 14px;
        border-radius: 16px;
        border: 1px dashed rgba(95, 99, 242, 0.28);
        background: rgba(95, 99, 242, 0.05);
        font-weight: 700;
        color: var(--app-text);
        cursor: pointer;
    }

    .app-file-trigger small {
        color: var(--app-muted);
        font-weight: 600;
    }

    .app-file-inline-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .app-file-inline-actions .btn {
        border-radius: 14px;
    }

    .app-file-name {
        font-size: 12px;
        color: var(--app-muted);
        min-height: 18px;
    }

    @media (max-width: 1199.98px) {
        .layout-navbar {
            margin-top: 10px;
        }
    }

    @media (max-width: 991.98px) {
        .layout-page {
            padding-bottom: calc(var(--app-nav-height) + env(safe-area-inset-bottom, 0px));
        }

        .content-wrapper {
            padding-bottom: calc(var(--app-nav-height) + env(safe-area-inset-bottom, 0px) + 14px);
        }

        .mobile-bottom-nav,
        .mobile-safe-bottom {
            display: flex;
        }

        .content-footer {
            padding-bottom: calc(var(--app-nav-height) + env(safe-area-inset-bottom, 0px));
        }
    }

    @media (max-width: 767.98px) {
        .layout-navbar {
            margin-top: 0;
            border-radius: 0 0 20px 20px;
            padding-top: max(10px, env(safe-area-inset-top, 0px));
        }

        .layout-page {
            padding-bottom: calc(var(--app-nav-height) + env(safe-area-inset-bottom, 0px));
        }

        .app-splash-card {
            width: min(88vw, 360px);
        }

        .app-install-banner {
            inset-inline: 10px;
        }
    }

    @keyframes app-spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes app-pulse {

        0%,
        100% {
            transform: translateX(0);
            opacity: 1;
        }

        50% {
            transform: translateX(6px);
            opacity: .72;
        }
    }
</style>
