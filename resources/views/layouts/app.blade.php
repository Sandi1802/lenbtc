<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Merah Len</title>
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Apply saved theme IMMEDIATELY before render to avoid flash -->
    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t) document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-header" style="display: flex; align-items: center; justify-content: flex-start; gap: 1.5rem; padding: 1.5rem 1rem; border-bottom: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <img src="/images/danantara.png" alt="Danantara Indonesia" style="height: 32px; object-fit: contain;">
                <img src="/images/len.png" alt="LEN Defend ID" style="height: 32px; object-fit: contain;">
            </div>
            <i class="ph ph-list" id="sidebarToggle" style="font-size: 1.5rem; color: var(--text-muted); cursor: pointer;"></i>
        </div>
        
        <nav class="sidebar-nav">
            <a href="/overview" class="nav-item {{ request()->is('overview') ? 'active' : '' }}">
                <i class="ph ph-folder-open"></i>
                Project Overview
            </a>
            
            <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="ph ph-squares-four"></i>
                Dashboard
            </a>

            <a href="/procurement" class="nav-item {{ request()->is('procurement') ? 'active' : '' }}">
                <i class="ph ph-shopping-cart"></i>
                Procurement
            </a>

            <div class="nav-item nav-dropdown {{ request()->is('master-data/*') ? 'active' : '' }}" onclick="toggleDropdown(this)">
                <div style="display: flex; align-items: center;">
                    <i class="ph ph-database"></i>
                    Master Data
                </div>
                <i class="ph ph-caret-down" style="margin-right: 0; font-size: 0.9rem;"></i>
            </div>
            
            <div class="nav-submenu {{ request()->is('master-data/*') ? 'open' : '' }}">
                <a href="/master-data/vessels" class="submenu-item {{ request()->is('master-data/vessels') ? 'active' : '' }}">Vessels</a>
                <a href="/master-data/stakeholders" class="submenu-item {{ request()->is('master-data/stakeholders') ? 'active' : '' }}">Stakeholders</a>
                <a href="/master-data/scope" class="submenu-item {{ request()->is('master-data/scope') ? 'active' : '' }}">Project Scope</a>
                <a href="/master-data/employees" class="submenu-item {{ request()->is('master-data/employees') ? 'active' : '' }}">Pegawai</a>
            </div>

            <div class="nav-item nav-dropdown {{ request()->is('logs/*') ? 'active' : '' }}" onclick="toggleDropdown(this)">
                <div style="display: flex; align-items: center;">
                    <i class="ph ph-file-text"></i>
                    Log
                </div>
                <i class="ph ph-caret-down" style="margin-right: 0; font-size: 0.9rem;"></i>
            </div>
            
            <div class="nav-submenu {{ request()->is('logs/*') ? 'open' : '' }}">
                <a href="/logs/issue" class="submenu-item {{ request()->is('logs/issue') ? 'active' : '' }}">Issue Log</a>
                <a href="/logs/risk" class="submenu-item {{ request()->is('logs/risk') ? 'active' : '' }}">Risk Register</a>
                <a href="/logs/notes" class="submenu-item {{ request()->is('logs/notes') ? 'active' : '' }}">Notes & Lesson Learn</a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Header -->
        <header class="top-header">
            <div class="page-title">@yield('title', 'Dashboard')</div>
            
            <div class="header-actions">
                <button class="icon-btn" id="themeToggle"><i class="ph ph-sun" id="themeIcon"></i></button>
                <button class="icon-btn"><i class="ph ph-bell"></i></button>
                
                <div class="user-profile" style="position: relative; cursor: pointer;" onclick="this.querySelector('.user-dropdown').classList.toggle('open')">
                    <div class="user-info" style="text-align: right;">
                        <span class="user-name">{{ Auth::user()->name ?? 'Super Admin' }}</span>
                        <span class="user-role" style="color: {{ Auth::user()?->roleBadgeColor() ?? '#E31837' }};">
                            {{ Auth::user()?->roleLabel() ?? 'Super Admin' }}
                        </span>
                    </div>
                    <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'SA', 0, 2)) }}</div>
                    <div class="user-dropdown" style="display:none; position: absolute; top: 110%; right: 0; background: var(--card-bg); border: 1px solid var(--border-color); border-radius: var(--radius-md); min-width: 180px; box-shadow: var(--shadow-md); z-index: 100; overflow: hidden;">
                        <div style="padding: 0.75rem 1rem; border-bottom: 1px solid var(--border-color);">
                            <div style="font-size: 0.75rem; color: var(--text-muted);">Login sebagai</div>
                            <div style="font-size: 0.85rem; font-weight: 600; color: var(--text-main);">{{ Auth::user()->name ?? '-' }}</div>
                            <span style="display:inline-block; margin-top:0.25rem; padding: 0.15rem 0.6rem; border-radius: 50px; font-size: 0.7rem; font-weight: 600; background: {{ Auth::user()?->roleBadgeColor() ?? '#E31837' }}22; color: {{ Auth::user()?->roleBadgeColor() ?? '#E31837' }};">
                                {{ Auth::user()?->roleLabel() ?? 'Super Admin' }}
                            </span>
                        </div>
                        <form action="{{ route('auth.logout') }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" style="width:100%; padding: 0.75rem 1rem; background:none; border:none; text-align:left; cursor:pointer; color: var(--text-main); font-size:0.875rem; display:flex; align-items:center; gap:0.5rem; font-family: inherit;">
                                <i class="ph ph-sign-out" style="color: var(--len-red);"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Container -->
        <div class="page-container">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleDropdown(element) {
            const submenu = element.nextElementSibling;
            submenu.classList.toggle('open');
            
            const caret = element.querySelector('.ph-caret-down') || element.querySelector('.ph-caret-up');
            if (caret) {
                if (submenu.classList.contains('open')) {
                    caret.classList.replace('ph-caret-down', 'ph-caret-up');
                } else {
                    caret.classList.replace('ph-caret-up', 'ph-caret-down');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Close user dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const profile = document.querySelector('.user-profile');
                const dropdown = document.querySelector('.user-dropdown');
                if (profile && dropdown && !profile.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
            document.querySelector('.user-profile')?.addEventListener('click', function() {
                const dropdown = this.querySelector('.user-dropdown');
                if (dropdown) {
                    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
                }
            });

            // Sidebar Toggle
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('mainSidebar');
            const mainContent = document.getElementById('mainContent');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('collapsed');
                });
            }


            // Theme Toggle (Dark Mode)
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            
            // Check local storage
            const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;
            if (currentTheme) {
                document.documentElement.setAttribute('data-theme', currentTheme);
                if (currentTheme === 'dark') {
                    themeIcon.classList.replace('ph-sun', 'ph-moon');
                }
            }

            themeToggle.addEventListener('click', function() {
                let theme = document.documentElement.getAttribute('data-theme');
                if (theme === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                    themeIcon.classList.replace('ph-moon', 'ph-sun');
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    themeIcon.classList.replace('ph-sun', 'ph-moon');
                }
            });

            // Initialize DataTables
            if ($('.datatable').length) {
                $('.datatable').each(function() {
                    var lastCol = $(this).find('thead th').length - 1;
                    $(this).DataTable({
                        dom: '<"dt-row-buttons"B><"dt-row-controls"lf>rt<"dt-bottom"ip><"clear">',
                        buttons: [
                            { extend: 'copy', text: '<i class="ph ph-copy"></i> Copy', className: 'dt-btn dt-btn-copy' },
                            { extend: 'excel', text: '<i class="ph ph-file-xls"></i> Excel', className: 'dt-btn dt-btn-excel' },
                            { extend: 'csv', text: '<i class="ph ph-file-csv"></i> CSV', className: 'dt-btn dt-btn-csv' },
                            { extend: 'pdf', text: '<i class="ph ph-file-pdf"></i> PDF', className: 'dt-btn dt-btn-pdf' }
                        ],
                        columnDefs: [
                            { orderable: false, targets: lastCol }
                        ],
                        language: {
                            search: "Cari:",
                            lengthMenu: "Tampilkan _MENU_ data",
                            info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 data",
                            emptyTable: "Belum ada data tersedia.",
                            zeroRecords: "Tidak ditemukan data yang cocok.",
                            paginate: {
                                first: "«",
                                last: "»",
                                next: "›",
                                previous: "‹"
                            }
                        }
                    });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
