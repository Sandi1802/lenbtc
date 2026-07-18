<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Risk;
use App\Models\Note;

class LogController extends Controller
{
    // === ISSUE LOG ===
    public function issues()
    {
        $issues = Issue::all();
        return view('logs.issue', compact('issues'));
    }

    public function storeIssue(Request $request)
    {
        Issue::create($request->all());
        return redirect()->route('logs.issues')->with('success', 'Issue berhasil ditambahkan!');
    }

    public function deleteIssue($id)
    {
        Issue::findOrFail($id)->delete();
        return redirect()->route('logs.issues')->with('success', 'Issue berhasil dihapus!');
    }

    // === RISK REGISTER ===
    public function risks()
    {
        $risks = Risk::all();
        return view('logs.risk', compact('risks'));
    }

    public function storeRisk(Request $request)
    {
        Risk::create($request->all());
        return redirect()->route('logs.risks')->with('success', 'Risk berhasil ditambahkan!');
    }

    public function deleteRisk($id)
    {
        Risk::findOrFail($id)->delete();
        return redirect()->route('logs.risks')->with('success', 'Risk berhasil dihapus!');
    }

    // === NOTES & LESSON LEARN ===
    public function notes()
    {
        $notes = Note::all();
        return view('logs.notes', compact('notes'));
    }

    public function storeNote(Request $request)
    {
        Note::create($request->all());
        return redirect()->route('logs.notes')->with('success', 'Note/Lesson Learn berhasil ditambahkan!');
    }

    public function deleteNote($id)
    {
        Note::findOrFail($id)->delete();
        return redirect()->route('logs.notes')->with('success', 'Note/Lesson Learn berhasil dihapus!');
    }
}
