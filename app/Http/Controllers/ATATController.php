<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atat;

class ATATController extends Controller
{
    public function index()
    {
        $atat = ATAT::all();
        return view('atat.index', compact('atat'));
    }

    public function create()
    {
        return view('atat.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_lot' => 'required|string',
            'no_hakmilik' => 'required|string',
            'cpc' => 'nullable|string',
            'jkr66a' => 'nullable|string',
            'doc_auc' => 'nullable|string',
        ]);

        ATAT::create($validatedData);
        return redirect()->route('atat.index')->with('success', 'Rekod ATAT berjaya ditambah.');
    }

    public function show($id)
    {
        $atat = ATAT::findOrFail($id);
        return view('atat.show', compact('atat'));
    }

    public function edit($id)
    {
        $atat = ATAT::findOrFail($id);
        return view('atat.edit', compact('atat'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bil' => 'required|integer',
            'no_lot' => 'required|string',
            'no_hakmilik' => 'required|string',
            'cpc' => 'nullable|string',
            'jkr66a' => 'nullable|string',
            'doc_auc' => 'nullable|string',
        ]);

        ATAT::whereId($id)->update($validatedData);
        return redirect()->route('atat.index')->with('success', 'Rekod ATAT berjaya dikemas kini.');
    }

    public function destroy($id)
    {
        ATAT::whereId($id)->delete();
        return redirect()->route('atat.index')->with('success', 'Rekod ATAT berjaya dihapuskan.');
    }
}
