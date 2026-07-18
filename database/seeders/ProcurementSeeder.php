<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procurement;

class ProcurementSeeder extends Seeder
{
    public function run()
    {
        Procurement::create([
            'project_id' => 'PRJ-2024-V2-0045',
            'project_name' => 'NusantaraX',
            'procurement_name' => 'Pengadaan Infrastruktur Server Regional Tahap 2',
            'vendor_name' => 'PT Global Teknologi Nusantara',
            'pr_number' => 'PR-88902-2024',
            'po_number' => 'PO-44501239',
            'po_value' => 2450000000,
            'currency' => 'IDR',
            'due_date' => '2024-12-31',
            'wbs' => 'WBS.24.IT.001.02',
            'status_hps' => true,
            'status_rks' => true,
            'status_topup' => false,
            'status_pr' => true,
            'status_rfq' => true,
            'status_nego' => false,
            'status_po' => false,
            'status_top' => false,
            'status_submit_dok' => false,
            'status_gr_ses' => false,
            'status_sptjb' => false,
            'no_spp' => null,
            'nilai_ket_transfer' => null
        ]);

        Procurement::create([
            'project_id' => 'PRJ-2024-V2-0046',
            'project_name' => 'AlphaCore',
            'procurement_name' => 'Lisensi Software Tahunan',
            'vendor_name' => 'PT Makmur Jaya',
            'pr_number' => 'PR-88902-2025',
            'po_number' => 'PO-44501240',
            'po_value' => 500000000,
            'currency' => 'IDR',
            'due_date' => '2024-11-30',
            'wbs' => 'WBS.24.IT.001.03',
            'status_hps' => true,
            'status_rks' => true,
            'status_topup' => true,
            'status_pr' => true,
            'status_rfq' => true,
            'status_nego' => true,
            'status_po' => true,
            'status_top' => false,
            'status_submit_dok' => false,
            'status_gr_ses' => false,
            'status_sptjb' => false,
            'no_spp' => null,
            'nilai_ket_transfer' => null
        ]);
    }
}
