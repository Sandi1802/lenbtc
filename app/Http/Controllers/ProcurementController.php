<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;

class ProcurementController extends Controller
{
    public function index()
    {
        $procurements = Procurement::all();
        return view('procurement', compact('procurements'));
    }

    public function create()
    {
        return view('procurement-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'       => 'required|string|max:100',
            'project_name'     => 'nullable|string|max:200',
            'procurement_name' => 'required|string|max:255',
            'vendor_name'      => 'required|string|max:255',
            'pr_number'        => 'nullable|string|max:100',
            'po_number'        => 'nullable|string|max:100',
            'po_value'         => 'nullable|numeric',
            'currency'         => 'nullable|string|max:10',
            'due_date'         => 'nullable|date',
            'wbs'              => 'nullable|string|max:100',
        ]);

        Procurement::create($validated);

        return redirect('/procurement')->with('success', 'Data pengadaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $procurement = Procurement::findOrFail($id);
        return view('procurement-detail', compact('procurement'));
    }

    public function update(Request $request, $id)
    {
        $procurement = Procurement::findOrFail($id);

        $data = $request->only([
            'project_id', 'project_name', 'procurement_name', 'vendor_name',
            'pr_number', 'po_number', 'po_value', 'currency', 'due_date', 'wbs',
            'no_spp', 'nilai_ket_transfer'
        ]);

        // Handle checkboxes (unchecked = not sent = false)
        $checkboxFields = [
            'status_hps', 'status_rks', 'status_topup', 'status_pr', 'status_rfq',
            'status_nego', 'status_po', 'status_top', 'status_submit_dok',
            'status_gr_ses', 'status_sptjb'
        ];
        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        $procurement->update($data);

        return redirect('/procurement/' . $id)->with('success', 'Data pengadaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        $procurement->delete();

        return redirect('/procurement')->with('success', 'Data pengadaan berhasil dihapus.');
    }
}
