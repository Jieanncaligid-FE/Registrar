<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Registrar Grading System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f8fbff;
            --bg-panel: #ffffff;
            --bg-sidebar: #f8f2ff;
            --text-primary: #23354e;
            --text-muted: #67728c;
            --accent: #8faee6;
            --accent-soft: #eff3ff;
            --accent-peach: #ffe7d6;
            --shadow-soft: 0 20px 50px rgba(74, 98, 147, 0.08);
            --border-soft: #e7ecf5;
            --radius: 24px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #f8fbff 0%, #f7f1ff 100%);
            color: var(--text-primary);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            padding: 2rem 1.5rem;
            background: linear-gradient(180deg, #f8f3ff 0%, #f8fbff 100%);
            border-right: 1px solid var(--border-soft);
            box-shadow: 6px 0 30px rgba(113, 120, 153, 0.08);
            z-index: 10;
            overflow-y: auto;
        }

        .sidebar .brand {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            color: var(--text-primary);
        }

        .sidebar .nav {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.95rem 1rem;
            border-radius: 18px;
            color: var(--text-muted);
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--text-primary);
            background: rgba(143, 174, 230, 0.18);
        }

        .sidebar .nav-link.active {
            font-weight: 600;
            background: linear-gradient(135deg, #c9d9ff 0%, #f1eeff 100%);
        }

        .sidebar .sidebar-footer {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-soft);
        }

        .sidebar .btn-soft-danger {
            border: 1px solid rgba(255, 121, 100, 0.16);
            background: rgba(255, 121, 100, 0.1);
            color: #b04f43;
            border-radius: 18px;
            font-weight: 600;
        }

        .sidebar .btn-soft-danger:hover {
            background: rgba(255, 121, 100, 0.16);
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 2rem 2rem 2.5rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .page-header h1 {
            margin: 0;
            font-size: clamp(1.75rem, 1.8vw, 2.25rem);
            line-height: 1.05;
        }

        .page-description {
            margin: 0.5rem 0 0;
            color: var(--text-muted);
            max-width: 620px;
        }

        .card-soft {
            background: var(--bg-panel);
            border: 1px solid var(--border-soft);
            border-radius: var(--radius);
            box-shadow: var(--shadow-soft);
        }

        .dashboard-cards {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-bottom: 1.75rem;
        }

        .dashboard-card {
            padding: 1.4rem;
            border-radius: 22px;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dashboard-card h2 {
            margin: 0.9rem 0 0;
            font-size: 2rem;
        }

        .dashboard-card small {
            display: block;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .dashboard-card.variant-1 { background: #eef4ff; }
        .dashboard-card.variant-2 { background: #fff2eb; }
        .dashboard-card.variant-3 { background: #f7f3ff; }
        .dashboard-card.variant-4 { background: #fff7e8; }

        .search-panel {
            background: var(--bg-panel);
            border: 1px solid var(--border-soft);
            border-radius: 22px;
            padding: 1.3rem;
            box-shadow: var(--shadow-soft);
            margin-bottom: 1.75rem;
        }

        .search-panel .form-control,
        .search-panel .form-select {
            border-radius: 999px;
            border: 1px solid var(--border-soft);
            background: #fcfdff;
            color: var(--text-primary);
            padding: 1rem 1.15rem;
        }

        .search-panel .btn {
            min-height: 52px;
            border-radius: 999px;
            padding: 0 1.5rem;
            font-weight: 600;
        }

        .table-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .table-card .card-header {
            background: transparent;
            border-bottom: none;
            padding: 1.45rem 1.75rem 0.75rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .table-card table {
            border-collapse: separate;
            border-spacing: 0;
            min-width: 100%;
        }

        .table-card thead th {
            position: sticky;
            top: 0;
            background: #f8f9ff;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-soft);
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .table-card tbody tr {
            transition: background 0.2s ease;
        }

        .table-card tbody tr:hover {
            background: #f6f8ff;
        }

        .table-card td {
            border-bottom: 1px solid #eff2f8;
            padding: 1rem 1.25rem;
            vertical-align: middle;
            color: var(--text-primary);
        }

        .table-card .btn-outline-primary {
            border-color: var(--accent);
            color: var(--accent);
            background: transparent;
            box-shadow: none;
        }

        .table-card .btn-outline-primary:hover {
            background: var(--accent-soft);
            color: var(--text-primary);
        }

        .featured-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
            padding: 1.5rem;
        }

        .featured-card h5 {
            margin-bottom: 1rem;
            color: var(--text-primary);
            font-weight: 700;
        }

        .featured-item {
            padding: 1rem 1rem;
            border-radius: 20px;
            background: #fcfdff;
            border: 1px solid #eef0f7;
            margin-bottom: 1rem;
            transition: transform 0.2s ease;
        }

        .featured-item:hover {
            transform: translateY(-2px);
        }

        .featured-item:last-child {
            margin-bottom: 0;
        }

        .featured-item .student-name {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .featured-item .student-meta {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .badge-success {
            background: #c6ffe3;
            color: #1f6d4f;
        }

        .badge-danger {
            background: #ffd9d0;
            color: #9f3f2e;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        @media (max-width: 1199px) {
            .dashboard-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .main-content {
                margin-left: 240px;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                border-right: none;
                box-shadow: none;
                padding: 1.5rem 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem 1rem 2rem;
            }

            .sidebar .nav {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .sidebar .nav-link {
                flex: 1 1 calc(50% - 0.5rem);
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-panel .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="brand">Registrar Dashboard</div>
    <nav class="nav">
        <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
        <a href="{{ route('subjects.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i>
            Subjects
        </a>
        <a href="{{ route('sections.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('sections.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Sections
        </a>
        <form method="POST" action="{{ route('logout') }}" class="sidebar-footer w-100">
            @csrf
            <button type="submit" class="btn btn-soft-danger w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>
    </nav>
</div>

<main class="main-content">
    <div class="page-header">
        <div>
            <h1>@yield('page-title')</h1>
            <p class="page-description">@yield('page-description')</p>
        </div>
        <div class="text-muted small">Logged in as {{ auth()->user()->name }}</div>
    </div>

    @include('partials.alerts')
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
