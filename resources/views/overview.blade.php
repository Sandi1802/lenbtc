@extends('layouts.app')

@section('title', 'Project Overview')

@section('content')
    <div class="project-hero">
        <div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.25rem;">Project Profile</div>
            <h1>Refurbishment KRI Tipe FPB - TRAK/505/PLN/IX/2022/AL</h1>
        </div>
        <div>
            <button class="btn btn-outline" style="color: white; border-color: rgba(255,255,255,0.4);">Structure Consortium</button>
        </div>
    </div>

    <div class="overview-grid">
        <!-- Project Manager -->
        <div class="col-span-12 card" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; align-items: center;">
            <div class="flex-start">
                <img src="https://ui-avatars.com/api/?name=Reindy+Dwien&background=E31837&color=fff" alt="PM" style="width: 50px; height: 50px; border-radius: 50%;">
                <div>
                    <div class="stat-label">Project Manager</div>
                    <div style="font-weight: 600; font-size: 1.1rem;">Reindy Dwien Suchendar, S.T., PMP®</div>
                </div>
            </div>
            
            <div class="insight-card card" style="padding: 1rem; border-radius: var(--radius-md); box-shadow: none; display: flex; align-items: center; gap: 1rem;">
                <div class="icon-box white">
                    <i class="ph ph-money"></i>
                </div>
                <div>
                    <div class="stat-label light">Project Value <i class="ph ph-eye-slash"></i></div>
                    <div class="stat-value" style="font-size: 1.25rem;">••••••••</div>
                </div>
            </div>
            
            <div class="card" style="padding: 1rem; border-radius: var(--radius-md); box-shadow: none; background: var(--bg-color); border: 1px solid var(--border-color); display: flex; align-items: center; gap: 1rem;">
                <div class="progress-circle">
                    <div class="progress-text">42%</div>
                </div>
                <div>
                    <div class="stat-label">Project Progress</div>
                    <div class="stat-value" style="font-size: 1.25rem; margin:0;">42.97%</div>
                    <div style="font-size: 0.75rem; color: var(--success);">Completed</div>
                </div>
            </div>
        </div>

        <!-- Project Scope -->
        <div class="col-span-6 card">
            <div class="flex-start" style="margin-bottom: 1rem;">
                <div class="icon-box blue" style="width: 40px; height: 40px; font-size: 1.25rem;">
                    <i class="ph ph-scan"></i>
                </div>
                <h3 style="font-size: 1rem; font-weight: 600;">Project Scope</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <ul class="issue-list" style="margin: 0; padding: 0;">
                    <li>CMS</li>
                    <li>NDDU</li>
                </ul>
                <ul class="issue-list" style="margin: 0; padding: 0;">
                    <li>Tactical Data Link</li>
                    <li>Intercom</li>
                </ul>
                <ul class="issue-list" style="margin: 0; padding: 0;">
                    <li>EO FCS</li>
                    <li>EO Sensor</li>
                    <li>Gyro INS</li>
                </ul>
            </div>
        </div>

        <!-- Vessels -->
        <div class="col-span-6 card">
            <div class="flex-start" style="margin-bottom: 1rem;">
                <div class="icon-box blue" style="width: 40px; height: 40px; font-size: 1.25rem;">
                    <i class="ph ph-boat"></i>
                </div>
                <h3 style="font-size: 1rem; font-weight: 600;">Vessels (4 Kapal)</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <ul class="vessel-list" style="margin: 0; padding: 0;">
                    <li><i class="ph-fill ph-boat text-blue"></i> Hiu-Todak</li>
                    <li><i class="ph-fill ph-boat text-blue"></i> Lemadang-Layang</li>
                </ul>
                <ul class="vessel-list" style="margin: 0; padding: 0;">
                    <li><i class="ph-fill ph-boat text-green"></i> Sura-Pandrong</li>
                    <li><i class="ph-fill ph-boat text-green"></i> Ajak-Singa</li>
                </ul>
                <ul class="vessel-list" style="margin: 0; padding: 0;">
                    <li><i class="ph-fill ph-boat text-red"></i> Kakap-Tongkol</li>
                    <li><i class="ph-fill ph-boat text-red"></i> Kerapu-Barakuda</li>
                </ul>
            </div>
        </div>


        <!-- High Level Issue -->
        <div class="col-span-12 card">
            <div class="flex-between" style="margin-bottom: 1rem;">
                <div class="flex-start">
                    <div class="icon-box red" style="width: 40px; height: 40px; font-size: 1.25rem;">
                        <i class="ph ph-warning-circle"></i>
                    </div>
                    <h3 style="font-size: 1rem; font-weight: 600;">High Level Issue</h3>
                </div>
                <a href="/logs/issue" style="font-size: 0.8rem; color: var(--text-muted); text-decoration: none;">View all <i class="ph ph-arrow-up-right"></i></a>
            </div>
            
            <ul class="mini-sticky-grid">
                <li class="mini-sticky red-sticky pinned" style="transform: rotate(-1deg);">
                    <div class="mini-sticky-header">
                        <i class="ph ph-warning-circle" style="color: var(--len-red);"></i> Critical
                    </div>
                    Keterlambatan Material Pengembangan CMS Phase 1 Eltran
                </li>
                <li class="mini-sticky red-sticky pinned" style="transform: rotate(1.5deg);">
                    <div class="mini-sticky-header">
                        <i class="ph ph-warning-circle" style="color: var(--len-red);"></i> Critical
                    </div>
                    Kesepahaman Dokumen Kontrak
                </li>
                <li class="mini-sticky red-sticky pinned" style="transform: rotate(-0.5deg);">
                    <div class="mini-sticky-header">
                        <i class="ph ph-warning-circle" style="color: var(--len-red);"></i> Critical
                    </div>
                    Manajemen Proyek PT PAL
                </li>
                <li class="mini-sticky yellow-sticky pinned" style="transform: rotate(1deg);">
                    <div class="mini-sticky-header">
                        <i class="ph ph-warning" style="color: #D97706;"></i> Warning
                    </div>
                    Ketersediaan Dokumen
                </li>
                <li class="mini-sticky yellow-sticky pinned" style="transform: rotate(-1.5deg);">
                    <div class="mini-sticky-header">
                        <i class="ph ph-warning" style="color: #D97706;"></i> Warning
                    </div>
                    Dashboard Project Konsorsium
                </li>
            </ul>
        </div>

        
        <!-- AI Analysis Section -->
        <div class="col-span-12 card executive-card" style="border-left: 4px solid var(--len-red);">
            <div class="flex-start" style="margin-bottom: 1rem;">
                <div class="icon-box red" style="width: 40px; height: 40px; font-size: 1.25rem;">
                    <i class="ph ph-brain"></i>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 600;">Executive Analysis Insight</h3>
            </div>
            <div style="font-size: 0.95rem; line-height: 1.6; color: var(--text-main);">
                <p style="margin-bottom: 0.75rem;">Berdasarkan data *Project Overview* saat ini, proyek Refurbishment KRI berada pada tingkat penyelesaian <strong>42.97%</strong>. Meskipun progres berjalan cukup baik, terdapat beberapa indikator risiko (High Level Issues) yang membutuhkan perhatian segera dari manajemen eksekutif:</p>
                <ol style="margin-left: 1.5rem; margin-bottom: 0.75rem; color: var(--text-muted);">
                    <li style="margin-bottom: 0.5rem;"><strong>Keterlambatan Material (CMS Phase 1 Eltran):</strong> Keterlambatan pasokan komponen kritis dapat memberikan efek domino pada fase instalasi dan integrasi (dijadwalkan Nov '27 - Mar '28). Diperlukan eskalasi kepada pihak *Principal* untuk mempercepat *delivery*.</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Manajemen Proyek Konsorsium (PT PAL):</strong> Terdapat tantangan sinkronisasi dengan PT PAL (Lead Konsorsium). Disarankan mengadakan *alignment meeting* level direksi untuk mempertegas kesepahaman dokumen kontrak dan *Scope of Work* (SoW).</li>
                </ol>
                <p><strong>Rekomendasi Strategis:</strong> Fokuskan sumber daya pada penyelesaian dokumen kontrak yang tertunda. Pastikan seluruh 4 kapal (Hiu-Todak, dll.) mendapat prioritas penjadwalan *dry-dock* yang tersinkronisasi agar masa garansi 1 tahun pasca *SAT* (Agustus 2028) dapat dimanfaatkan dengan maksimal tanpa ada *downtime* tambahan.</p>
            </div>
        </div>
    </div>
@endsection
