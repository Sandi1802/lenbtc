@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Summary Stats Row -->
    <div class="overview-grid" style="margin-bottom: 2rem;">
        <div class="col-span-3 card" style="border-left: 4px solid var(--len-red); display: flex; align-items: center; gap: 1rem;">
            <div class="icon-box red" style="width: 48px; height: 48px;">
                <i class="ph ph-shopping-cart" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <div class="stat-label">Procurement</div>
                <div class="stat-value">{{ $totalProcurement }} Data</div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">Avg. Progress: {{ $avgProgress }}%</div>
            </div>
        </div>
        <div class="col-span-3 card" style="border-left: 4px solid var(--primary); display: flex; align-items: center; gap: 1rem;">
            <div class="icon-box blue" style="width: 48px; height: 48px;">
                <i class="ph ph-list-checks" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <div class="stat-label">Engineering</div>
                <div class="stat-value">7%</div>
            </div>
        </div>
        <div class="col-span-3 card" style="border-left: 4px solid var(--warning); display: flex; align-items: center; gap: 1rem;">
            <div class="icon-box yellow" style="width: 48px; height: 48px;">
                <i class="ph ph-warning" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <div class="stat-label">Contraction</div>
                <div class="stat-value">0%</div>
            </div>
        </div>
        <div class="col-span-3 card" style="border-left: 4px solid var(--success); display: flex; align-items: center; gap: 1rem;">
            <div class="icon-box green" style="width: 48px; height: 48px;">
                <i class="ph ph-chart-line-up" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <div class="stat-label">Commisioning</div>
                <div class="stat-value">42.97%</div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="overview-grid" style="margin-bottom: 2rem; grid-template-columns: repeat(12, 1fr);">
        <!-- Pie Chart (Progress) -->
        <div class="col-span-4 card" style="display: flex; flex-direction: column;">
            <div class="flex-between" style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1rem; font-weight: 600;">Overview Progress</h3>
            </div>
            <div style="flex: 1; position: relative; display: flex; justify-content: center; align-items: center; min-height: 250px;">
                <canvas id="progressPieChart"></canvas>
            </div>
        </div>

        <!-- Line Chart (S-Curve) -->
        <div class="col-span-8 card" style="display: flex; flex-direction: column;">
            <div class="flex-between" style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1rem; font-weight: 600;">S-Curve Planning vs Actual</h3>
            </div>
            <div style="flex: 1; position: relative; min-height: 300px;">
                <canvas id="sCurveChart"></canvas>
            </div>
        </div>
    </div>

  <!-- Script for Charts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Read theme AFTER it has been applied (early script in <head> ensures this is correct)
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const textColor = isDark ? '#F1F5F9' : '#1e293b';
        const mutedColor = isDark ? '#94A3B8' : '#64748B';
        const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.08)';
        const cardBg = isDark ? '#1E293B' : '#ffffff';

        // Apply Chart.js global defaults so ALL charts inherit correct colors
        Chart.defaults.color = textColor;
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.font.size = 13;

        // ---- PIE CHART ----
        const pieCtx = document.getElementById('progressPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Procurement', 'Engineering', 'Construction', 'Commissioning'],
                datasets: [{
                    data: [{{ $avgProgress }}, 30, 20, 10],
                    backgroundColor: ['#A40917', '#E42313', '#C40D0E', '#FF6121'],
                    hoverBackgroundColor: ['#8A0713', '#C71E10', '#A80B0C', '#E5551C'],
                    borderWidth: 3,
                    borderColor: cardBg,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: { padding: { bottom: 10 } },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: { family: "'Inter', sans-serif", size: 13, weight: '500' }
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(15,23,42,0.95)' : 'rgba(255,255,255,0.95)',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 4,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return '  ' + context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                animation: { animateRotate: true, animateScale: true, duration: 800, easing: 'easeOutQuart' }
            }
        });

        // ---- S-CURVE LINE CHART ----
        const sCurveCtx = document.getElementById('sCurveChart').getContext('2d');
        new Chart(sCurveCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Plan',
                        data: [5, 10, 20, 35, 50, 65, 80, 90, 95, 98, 99, 100],
                        borderColor: '#60A5FA',
                        backgroundColor: 'rgba(96,165,250,0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#60A5FA'
                    },
                    {
                        label: 'Actual',
                        data: [2, 8, 15, 25, 40, 45, 55, null, null, null, null, null],
                        borderColor: '#E31837',
                        backgroundColor: 'transparent',
                        borderWidth: 2.5,
                        borderDash: [6, 4],
                        tension: 0.4,
                        fill: false,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#E31837'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            color: textColor,
                            usePointStyle: true,
                            pointStyle: 'line',
                            padding: 20,
                            font: { family: "'Inter', sans-serif", size: 13 }
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(15,23,42,0.95)' : 'rgba(255,255,255,0.95)',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                if (context.raw === null) return null;
                                return '  ' + context.dataset.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { color: mutedColor, font: { size: 12 } },
                        border: { color: gridColor }
                    },
                    y: {
                        min: 0,
                        max: 100,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: {
                            color: mutedColor,
                            font: { size: 12 },
                            callback: function(value) { return value + '%'; }
                        },
                        border: { color: gridColor }
                    }
                }
            }
        });
    });
</script>

    <!-- Pengajuan & Kalender Row -->
    <div class="overview-grid" style="grid-template-columns: repeat(12, 1fr); align-items: start; margin-bottom: 2rem;">
        
        <!-- Informasi Pengajuan (Kiri) -->
        <div class="col-span-4 card" style="height: 520px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem;">Informasi Issue</h3>
            <div style="flex: 1; overflow-y: auto; padding-right: 0.5rem; display: flex; flex-direction: column; gap: 1rem;">
                
                <!-- Item 1 -->
                <div style="border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; line-height: 1.4; color: var(--text-main);">[Tabel Perbaikan] Developer baru saja merubah status temuan produk NusantaraX.</div>
                    <div style="color: var(--text-muted); font-size: 0.75rem; display: flex; align-items: center; gap: 0.3rem;">
                        <i class="ph ph-clock"></i> 25 Juni 2025 - 07:55
                    </div>
                </div>

                <!-- Item 2 -->
                <div style="border: 1px solid var(--border-color); border-left: 4px solid var(--len-red); border-radius: 8px; padding: 1rem;">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; line-height: 1.4; color: var(--text-main);">[Tabel Perbaikan] Developer baru saja merubah status temuan produk NusantaraX.</div>
                    <div style="color: var(--text-muted); font-size: 0.75rem; display: flex; align-items: center; gap: 0.3rem;">
                        <i class="ph ph-clock"></i> 25 Juni 2025 - 07:55
                    </div>
                </div>

                <!-- Item 3 -->
                <div style="border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; line-height: 1.4; color: var(--text-main);">[Tabel Perbaikan] Developer baru saja merubah status temuan produk 123 Makmur Jaya.</div>
                    <div style="color: var(--text-muted); font-size: 0.75rem; display: flex; align-items: center; gap: 0.3rem;">
                        <i class="ph ph-clock"></i> 26 Desember 2024 - 09:24
                    </div>
                </div>

                 <!-- Item 4 -->
                 <div style="border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; line-height: 1.4; color: var(--text-main);">[Tabel Perbaikan] Developer baru saja merubah status temuan produk Alpha.</div>
                    <div style="color: var(--text-muted); font-size: 0.75rem; display: flex; align-items: center; gap: 0.3rem;">
                        <i class="ph ph-clock"></i> 20 Januari 2024 - 11:15
                    </div>
                </div>
            </div>
        </div>

        <!-- Kalender & Detail (Kanan) -->
        <div class="col-span-8 card" style="height: 520px; display: flex; flex-direction: column;">
            <div style="display: flex; gap: 2rem; flex: 1;">
                
                <!-- Area Kalender -->
                <div style="flex: 1.2; display: flex; flex-direction: column;">
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem;">Kalender</h3>
                    
                    <div style="position: relative;">
                        <div class="flex-between" style="margin-bottom: 1rem;">
                            <span id="month-year-display" onclick="toggleMonthPicker()" style="font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 0.3rem;">
                                Juli 2026 <i class="ph ph-caret-down" style="font-size: 0.8rem;"></i>
                            </span>
                            <div style="display: flex; gap: 0.5rem;">
                                <button id="prev-month-btn" class="btn btn-outline" style="padding: 0.25rem 0.5rem; border-radius: 50%;"><i class="ph ph-caret-left"></i></button>
                                <button id="next-month-btn" class="btn btn-outline" style="padding: 0.25rem 0.5rem; border-radius: 50%;"><i class="ph ph-caret-right"></i></button>
                            </div>
                        </div>

                        <!-- Month Picker Popup -->
                        <div id="month-picker" style="display: none; position: absolute; top: 2.2rem; left: 0; background: #2f364a; color: white; border-radius: 8px; padding: 1rem; z-index: 100; width: 200px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);">
                            <div style="position: absolute; top: -5px; left: 20px; width: 0; height: 0; border-left: 6px solid transparent; border-right: 6px solid transparent; border-bottom: 6px solid #2f364a;"></div>
                            
                            <div class="flex-between" style="margin-bottom: 1rem; padding: 0 0.2rem;">
                                <button id="picker-prev-year" style="background: none; border: none; color: white; cursor: pointer; padding: 0;"><i class="ph ph-caret-left"></i></button>
                                <span id="picker-year-display" style="font-weight: 600; font-size: 0.95rem;">2026</span>
                                <button id="picker-next-year" style="background: none; border: none; color: white; cursor: pointer; padding: 0;"><i class="ph ph-caret-right"></i></button>
                            </div>
                            <div id="month-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; text-align: center;">
                                <!-- Dimuat oleh JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Grid Kalender -->
                    <div id="calendar-days" style="display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 0.6rem 0.2rem; font-size: 0.85rem;">
                        <!-- Dimuat oleh JS -->
                    </div>

                    <!-- Legend -->
                    <div style="display: flex; gap: 1.5rem; justify-content: center; margin-top: 2rem; font-size: 0.75rem; font-weight: 500;">
                        <div style="display: flex; align-items: center; gap: 0.3rem;"><span style="width: 8px; height: 8px; border-radius: 50%; background: var(--len-red);"></span> High</div>
                        <div style="display: flex; align-items: center; gap: 0.3rem;"><span style="width: 8px; height: 8px; border-radius: 50%; background: #F97316;"></span> Medium</div>
                        <div style="display: flex; align-items: center; gap: 0.3rem;"><span style="width: 8px; height: 8px; border-radius: 50%; background: #FDE047;"></span> Low</div>
                    </div>

                    <!-- Aktivitas Digitalpass -->
                </div>

                <!-- Area Detail Kegiatan -->
                <div style="flex: 1; display: flex; flex-direction: column;">
                    <div class="flex-between" style="margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 600;">Detail Kegiatan</h3>
                        <button class="btn btn-primary" style="font-size: 0.75rem; padding: 0.4rem 0.8rem; display: flex; align-items: center; gap: 0.3rem;">
                            <i class="ph ph-plus-circle" style="font-size: 1rem;"></i> Tambah Agenda
                        </button>
                    </div>
                    
                    <!-- Content Card Detail -->
                    <div style="border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div class="flex-between" style="align-items: flex-start;">
                            <div>
                                <div style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.25rem; color: var(--text-main);">Antares</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">Usability Testing</div>
                            </div>
                            <span style="background: var(--warning-bg); border: 1px solid rgba(245,158,11,0.3); color: var(--warning); padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 600;">Pengujian Produk</span>
                        </div>
                        <div style="font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;">
                            <i class="ph ph-calendar-blank" style="font-size: 1.1rem; color: var(--text-main);"></i> 20 Mei - 02 Juli 2026
                        </div>
                    </div>
                    
                    <!-- Area kosong placeholder / notifikasi -->
                    <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0.5; margin-top: 1rem;">
                        <i class="ph ph-folder-dashed" style="font-size: 3rem; margin-bottom: 0.5rem;"></i>
                        <span style="font-size: 0.85rem;">Pilih tanggal lain untuk melihat jadwal</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const shortMonthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    let currentDate = new Date();

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        document.getElementById('month-year-display').innerHTML = `${monthNames[month]} ${year} <i class="ph ph-caret-down" style="font-size: 0.8rem;"></i>`;
        document.getElementById('picker-year-display').innerText = year;
        
        const daysContainer = document.getElementById('calendar-days');
        daysContainer.innerHTML = `
            <div style="color: var(--text-muted); font-weight: 500;">S</div>
            <div style="color: var(--text-muted); font-weight: 500;">S</div>
            <div style="color: var(--text-muted); font-weight: 500;">R</div>
            <div style="color: var(--text-muted); font-weight: 500;">K</div>
            <div style="color: var(--text-muted); font-weight: 500;">J</div>
            <div style="color: var(--text-muted); font-weight: 500;">S</div>
            <div style="color: var(--text-muted); font-weight: 500;">M</div>
        `;
        
        // Dapatkan index hari pertama dalam bulan (0 = Minggu, 1 = Senin, dst)
        // Karena kalender kita mulai dari Senin (S, S, R, K, J, S, M)
        let firstDay = new Date(year, month, 1).getDay();
        let firstDayIndex = firstDay === 0 ? 6 : firstDay - 1; 
        
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();
        
        // Render tanggal bulan sebelumnya (redup)
        for (let i = firstDayIndex; i > 0; i--) {
            daysContainer.innerHTML += `<div style="color: var(--text-muted); opacity: 0.5;">${prevMonthDays - i + 1}</div>`;
        }
        
        // Render tanggal bulan ini
        const today = new Date();
        for (let i = 1; i <= daysInMonth; i++) {
            let isToday = i === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            
            // Dummy logic untuk highlight (agar mirip mock UI)
            let isWarning = i === 1 && month === 6 && year === 2026; // 1 Juli 2026
            
            let style = 'padding: 0.2rem; cursor: pointer; border-radius: 4px;';
            if (isToday) {
                style += ' border: 1px solid var(--len-red); font-weight: 600; color: var(--len-red);';
            } else if (isWarning) {
                style += ' background: #FEF3C7; font-weight: 600; color: #D97706;';
            } else {
                style += ' hover:background: var(--border-color);';
            }
            
            daysContainer.innerHTML += `<div style="${style}" class="cal-day" onmouseover="this.style.background='var(--border-color)'" onmouseout="this.style.background='${isWarning ? '#FEF3C7' : 'transparent'}'">${i}</div>`;
        }
        
        // Render sisa hari bulan berikutnya
        const totalCells = firstDayIndex + daysInMonth;
        let nextDays = 42 - totalCells; 
        if (nextDays > 7) nextDays -= 7; // Hindari row kosong ekstra
        
        for (let i = 1; i <= nextDays; i++) {
            daysContainer.innerHTML += `<div style="color: var(--text-muted); opacity: 0.5;">${i}</div>`;
        }
        
        renderMonthPicker();
    }

    function renderMonthPicker() {
        const grid = document.getElementById('month-grid');
        grid.innerHTML = '';
        const currentMonth = currentDate.getMonth();
        
        shortMonthNames.forEach((m, index) => {
            let isCurrent = index === currentMonth;
            // Gunakan warna terang untuk highlight bulan yang aktif
            let bg = isCurrent ? '#f1f5f9' : 'transparent';
            let color = isCurrent ? '#0f172a' : 'white';
            
            grid.innerHTML += `<div class="picker-month" data-month="${index}" style="padding: 0.4rem; border-radius: 6px; cursor: pointer; background: ${bg}; color: ${color}; font-weight: 500; font-size: 0.85rem;" onmouseover="if(!${isCurrent}) this.style.background='rgba(255,255,255,0.1)'" onmouseout="if(!${isCurrent}) this.style.background='transparent'">${m}</div>`;
        });
        
        document.querySelectorAll('.picker-month').forEach(el => {
            el.addEventListener('click', (e) => {
                currentDate.setMonth(parseInt(e.target.dataset.month));
                renderCalendar();
                document.getElementById('month-picker').style.display = 'none';
            });
        });
    }

    function toggleMonthPicker() {
        const picker = document.getElementById('month-picker');
        picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
    }

    document.getElementById('prev-month-btn').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('next-month-btn').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    document.getElementById('picker-prev-year').addEventListener('click', (e) => {
        e.stopPropagation(); // Mencegah popup tertutup
        currentDate.setFullYear(currentDate.getFullYear() - 1);
        renderCalendar();
    });

    document.getElementById('picker-next-year').addEventListener('click', (e) => {
        e.stopPropagation();
        currentDate.setFullYear(currentDate.getFullYear() + 1);
        renderCalendar();
    });

    // Sembunyikan picker jika klik di luar
    document.addEventListener('click', function(event) {
        const picker = document.getElementById('month-picker');
        const display = document.getElementById('month-year-display');
        if (!picker.contains(event.target) && !display.contains(event.target)) {
            picker.style.display = 'none';
        }
    });

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', () => {
        renderCalendar();
    });
</script>
@endpush
