<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ATAB;

class ATABController extends Controller
{
    public function index()
    {
        $atab = ATAB::all();
        return view('atab.index', compact('atab'));
    }

    public function create()
    {
        return view('atab.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'no_lot' => 'required',
            'no_hakmilik' => 'required',
            'jpph' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'sap' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'geran' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'dokumen_a1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx',
            'dokumen_b1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx',
        ]);

        // Proses dan simpan fail JPPH
        if ($request->hasFile('jpph')) {
            $jpphPath = $request->file('jpph')->store('jpph_files', 'public');
        } else {
            $jpphPath = null; // Jika fail tidak di-upload
        }

        // Proses dan simpan fail S&P
        if ($request->hasFile('sap')) {
            $sapPath = $request->file('sap')->store('sap_files', 'public');
        } else {
            $sapPath = null;
        }

        // Proses dan simpan fail Geran
        if ($request->hasFile('geran')) {
            $geranPath = $request->file('geran')->store('geran_files', 'public');
        } else {
            $geranPath = null;
        }



        // Simpan rekod ATAB
        ATAB::create([
            'no_lot' => $request->input('no_lot'),
            'no_hakmilik' => $request->input('no_hakmilik'),
            'jpph' => $jpphPath,  // Simpan path fail JPPH
            'sap' => $sapPath,    // Simpan path fail S&P
            'geran' => $geranPath, // Simpan path fail Geran
            
        ]);

        return redirect()->route('atab.index')->with('success', 'Rekod ATAB berjaya disimpan');

        foreach (['dokumen_a1', 'dokumen_a2', 'dokumen_a3', 'dokumen_a4', 'dokumen_b1', 'dokumen_b2', 'dokumen_b3', 'dokumen_b4','dokumen_b5', 'dokumen_b6', 'dokumen_b7', 'dokumen_b8','dokumen_b9', 'dokumen_b10', 'dokumen_b11', 'dokumen_b12'] as $dokumen) {
            if ($request->hasFile($dokumen)) {
                $file = $request->file($dokumen);
                $filePath = $file->store('uploads/atab', 'public'); // Simpan fail di dalam storage/app/public/uploads/atab
    
                // Simpan maklumat fail ke dalam database
                LainLainFile::create([
                    'record_id' => $request->record_id, // Pastikan anda pass 'record_id' dari form
                    'dokumen_type' => $dokumen,
                    'file_path' => $filePath,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Fail telah berjaya di-upload.');
    
    }

    public function edit($id)
    {
        $atabRecord = ATAB::findOrFail($id);
        return view('atab.edit', compact('atabRecord'));
    }

    public function update(Request $request, $id)
    {
        // Sama seperti store, tetapi untuk mengemas kini rekod
    }

    public function destroy($id)
    {
        $atabRecord = ATAB::findOrFail($id);
        $atabRecord->delete();

        return redirect()->route('atab.index')->with('success', 'Rekod ATAB berjaya dihapuskan');
    }
}
