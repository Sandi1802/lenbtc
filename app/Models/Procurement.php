<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'project_name', 'procurement_name', 'vendor_name', 
        'pr_number', 'po_number', 'po_value', 'currency', 'due_date', 'wbs',
        'status_hps', 'status_rks', 'status_topup', 'status_pr', 'status_rfq', 
        'status_nego', 'status_po', 'status_top', 'status_submit_dok', 
        'status_gr_ses', 'status_sptjb',
        'no_spp', 'nilai_ket_transfer'
    ];

    public function getProgressPercentageAttribute()
    {
        $checklists = [
            $this->status_hps,
            $this->status_rks,
            $this->status_topup,
            $this->status_pr,
            $this->status_rfq,
            $this->status_nego,
            $this->status_po,
            $this->status_top,
            $this->status_submit_dok,
            $this->status_gr_ses,
            $this->status_sptjb,
        ];

        $completed = count(array_filter($checklists));
        $total = count($checklists);
        
        return $total > 0 ? round(($completed / $total) * 100) : 0;
    }
}
