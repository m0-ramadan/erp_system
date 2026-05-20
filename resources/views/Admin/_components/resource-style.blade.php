<style>
    body {
        font-family: "Cairo", "Tajawal", sans-serif !important;
    }

    .qw-page {
        padding-top: 24px;
        padding-bottom: 24px;
    }

    .qw-page .container-xxl,
    .container-xxl.qw-page {
        position: relative;
    }

    .qw-hero {
        position: relative;
        overflow: hidden;
        color: #fff;
        border-radius: 22px;
        padding: 28px;
        margin-bottom: 22px;
        background: linear-gradient(135deg, #5f63f2 0%, #8b5cf6 48%, #0ea5e9 100%);
        box-shadow: 0 22px 50px rgba(95, 99, 242, .24);
    }

    .qw-hero::after {
        content: "";
        position: absolute;
        inset-inline-end: -70px;
        inset-block-start: -70px;
        width: 210px;
        height: 210px;
        background: rgba(255, 255, 255, .16);
        border-radius: 50%;
    }

    .qw-hero h1 {
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .qw-hero p {
        margin: 0;
        opacity: .92;
    }

    .qw-hero .qw-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .14);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .02em;
    }

    .qw-hero .qw-icon {
        width: 76px;
        height: 76px;
        border-radius: 22px;
        background: rgba(255, 255, 255, .18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .18);
    }

    .qw-card {
        background: var(--bs-card-bg, #302e4b);
        border-radius: 18px;
        border: 1px solid rgba(105, 108, 255, .08);
        box-shadow: 0 14px 34px rgba(18, 38, 63, .08);
        margin-bottom: 22px;
    }

    .qw-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid rgba(0, 0, 0, .06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .qw-card-body {
        padding: 22px;
    }

    .qw-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        margin: 0;
        color: var(--bs-heading-color, #222);
    }

    .qw-section-title i {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: linear-gradient(135deg, #5f63f2, #8b5cf6);
    }

    .qw-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .qw-stat {
        padding: 20px;
        border-radius: 18px;
        background: var(--bs-card-bg, #302e4b);
        box-shadow: 0 12px 30px rgba(18, 38, 63, .08);
        position: relative;
        overflow: hidden;
    }

    .qw-stat::before {
        content: "";
        position: absolute;
        inset-block: 0;
        inset-inline-start: 0;
        width: 5px;
        background: linear-gradient(180deg, #5f63f2, #0ea5e9);
    }

    .qw-stat .label {
        color: var(--bs-secondary-color, #697a8d);
        font-size: 13px;
        font-weight: 700;
    }

    .qw-stat .number {
        font-size: 26px;
        font-weight: 900;
        margin-top: 5px;
    }

    .qw-quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px;
        margin-bottom: 22px;
    }

    .qw-quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border-radius: 18px;
        text-decoration: none;
        color: inherit;
        background: var(--bs-card-bg, #302e4b);
        box-shadow: 0 12px 30px rgba(18, 38, 63, .08);
        border: 1px solid rgba(95, 99, 242, .08);
    }

    .qw-quick-action i {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        color: #fff;
        background: linear-gradient(135deg, #5f63f2, #0ea5e9);
    }

    .qw-quick-action strong {
        display: block;
        font-size: 14px;
    }

    .qw-quick-action span {
        display: block;
        margin-top: 2px;
        font-size: 12px;
        color: var(--bs-secondary-color, #697a8d);
    }

    .qw-list-stack {
        display: grid;
        gap: 12px;
    }

    .qw-list-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 14px;
        border-radius: 16px;
        background: rgba(95, 99, 242, .045);
        border: 1px solid rgba(95, 99, 242, .08);
    }

    .qw-list-item .meta {
        min-width: 0;
    }

    .qw-list-item .meta strong,
    .qw-list-item .meta div {
        display: block;
        font-weight: 800;
    }

    .qw-list-item .meta small {
        display: block;
        margin-top: 4px;
    }

    .qw-filter-grid,
    .qw-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 16px;
    }

    .qw-form-grid .span-2 {
        grid-column: span 2;
    }

    @media(max-width: 768px) {
        .qw-form-grid .span-2 {
            grid-column: span 1;
        }
    }

    .qw-label {
        font-weight: 800;
        font-size: 13px;
        margin-bottom: 8px;
        color: var(--bs-heading-color, #222);
    }

    .qw-input,
    .qw-card .form-control,
    .qw-card .form-select {
        border-radius: 13px;
        min-height: 44px;
    }

    .qw-table-wrap {
        overflow-x: auto;
    }

    .qw-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .qw-table thead th {
        background: rgba(95, 99, 242, .06);
        color: var(--bs-heading-color, #222);
        font-weight: 800;
        white-space: nowrap;
        border-bottom: 0;
    }

    .qw-table tbody td {
        white-space: nowrap;
    }

    .qw-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        background: rgba(95, 99, 242, .10);
        color: #5f63f2;
    }

    .qw-badge.success {
        background: rgba(25, 135, 84, .12);
        color: #198754;
    }

    .qw-badge.danger {
        background: rgba(220, 53, 69, .12);
        color: #dc3545;
    }

    .qw-badge.warning {
        background: rgba(255, 193, 7, .16);
        color: #b58100;
    }

    .qw-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: flex-end;
    }

    .qw-empty {
        padding: 40px 20px;
        text-align: center;
        color: var(--bs-secondary-color, #697a8d);
    }

    .qw-empty i {
        font-size: 42px;
        margin-bottom: 10px;
        opacity: .55;
    }

    .qw-detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 14px;
    }

    .qw-detail {
        padding: 16px;
        border: 1px dashed rgba(105, 108, 255, .18);
        border-radius: 16px;
        background: rgba(105, 108, 255, .035);
    }

    .qw-detail .label {
        color: var(--bs-secondary-color, #697a8d);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .qw-detail .value {
        font-weight: 700;
        word-break: break-word;
        white-space: pre-wrap;
    }

    .qw-pagination .pagination {
        gap: 8px;
        flex-wrap: wrap;
    }

    .qw-pagination .page-link {
        min-width: 42px;
        height: 42px;
        border: 0;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: var(--bs-heading-color, #222);
        background: rgba(95, 99, 242, .08);
        box-shadow: none;
    }

    .qw-pagination .page-item.active .page-link {
        color: #fff;
        background: linear-gradient(135deg, #5f63f2, #8b5cf6);
    }

    .qw-pagination .page-item.disabled .page-link {
        color: var(--bs-secondary-color, #697a8d);
        background: rgba(105, 122, 141, .12);
    }

    @media(max-width: 991.98px) {
        .qw-page {
            padding-top: 16px;
            padding-bottom: 12px;
        }

        .qw-hero {
            padding: 22px 18px;
            border-radius: 20px;
        }

        .qw-hero h1 {
            font-size: 24px;
        }

        .qw-hero .qw-icon {
            width: 62px;
            height: 62px;
            font-size: 28px;
        }

        .qw-card-header,
        .qw-card-body {
            padding: 18px;
        }

        .qw-table thead th,
        .qw-table tbody td {
            font-size: 13px;
        }
    }

    @media(max-width: 767.98px) {
        .qw-page {
            padding-top: 12px;
        }

        .qw-stats-grid,
        .qw-quick-actions,
        .qw-filter-grid,
        .qw-form-grid,
        .qw-detail-grid {
            grid-template-columns: 1fr;
        }

        .qw-card {
            border-radius: 20px;
        }

        .qw-card-header {
            align-items: flex-start;
        }

        .qw-actions {
            justify-content: flex-start;
        }

        .qw-table-wrap {
            border-top: 1px solid rgba(95, 99, 242, .08);
        }

        .qw-pagination .pagination {
            justify-content: center;
        }
    }
</style>
