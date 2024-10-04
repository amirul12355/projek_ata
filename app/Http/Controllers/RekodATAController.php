<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekodAset;
use App\Exports\RekodAsetExport;
use PDF;

class RekodATAController extends Controller
{
    // Fungsi untuk memaparkan halaman utama rekod
    public function index(Request $request)
    {

        // Ambil query asas untuk RekodAset
        $query = RekodAset::query();

        if ($request->filled('kod_ao')) {
            $query->where('kod_ao', $request->kod_ao);
        }
    

        // Penapisan berdasarkan Kod PTJ
        if ($request->has('kod_ptj') && $request->kod_ptj != '') {
            $query->where('kod_ptj', $request->kod_ptj);
        }

        // Penapisan berdasarkan Nama PTJ
        if ($request->has('nama_ptj') && $request->nama_ptj != '') {
            $query->where('nama_ptj', $request->nama_ptj);
        }

        // Penapisan berdasarkan Negeri
        if ($request->has('negeri') && $request->negeri != '') {
            $query->where('negeri', $request->negeri);
        }

        // Penapisan berdasarkan Daerah
        if ($request->has('daerah') && $request->daerah != '') {
            $query->where('daerah', $request->daerah);
        }

        // Penapisan berdasarkan Bandar
        if ($request->has('bandar') && $request->bandar != '') {
            $query->where('bandar', $request->bandar);
        }

        // Dapatkan data selepas penapisan
        $rekod_aset = $query->paginate(10);

        // Ambil senarai unik untuk dropdown
        $kod_ao_list = RekodAset::select('kod_ao')->distinct()->get();
        $kod_ptj_list = RekodAset::distinct()->pluck('kod_ptj');
        $nama_ptj_list = RekodAset::distinct()->pluck('nama_ptj');
        $negeri_list = RekodAset::distinct()->pluck('negeri');
        $daerah_list = RekodAset::distinct()->pluck('daerah');
        $bandar_list = RekodAset::distinct()->pluck('bandar');


        //$rekod_aset = RekodAset::all();
        $rekod_aset = RekodAset::paginate(10);
        return view('rekodATA.index', compact( 'rekod_aset', 'kod_ao_list', 'kod_ptj_list', 'nama_ptj_list', 'negeri_list', 'daerah_list', 'bandar_list'));
        
    }

    // Fungsi untuk menyimpan data ke dalam database
    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validatedData = $request->validate([
            'kod_ao' => 'required',
            'kod_ptj' => 'required',
            'nama_ptj' => 'required',
            'negeri' => 'required',
            'daerah' => 'required',
            'bandar' => 'required',
            'no_lot' => 'required',
            'no_hakmilik' => 'required',
            'luas_tanah' => 'required',
            
            'nilai_tanah_jpph' => 'required|numeric',
            'nilai_bangunan_jpph' => 'required|numeric',
            'nilai_tanah_igfmas' => 'required|numeric',
            'nilai_bangunan_igfmas' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        // Menyimpan data ke dalam table rekod_aset
        RekodAset::create($validatedData);

        // Redirect ke halaman utama dengan mesej berjaya
        return redirect()->route('rekodATA.index')->with('success', 'Rekod berjaya disimpan');
    }

    // Fungsi untuk eksport ke dalam format Excel
    public function exportExcel()
    {
        return Excel::download(new RekodAsetExport, 'rekod_aset.xlsx');
    }

    // Fungsi untuk eksport ke dalam format PDF
    public function exportPDF()
    {
        $data = RekodAset::all();
        $pdf = PDF::loadView('rekodATA.rekod_aset_pdf', compact('rekod_aset'));
        return $pdf->download('rekod_aset.pdf');
    }

    public function show($id)
{
    $rekodATA = aset_tak_alih::with(['atat', 'atab'])->findOrFail($id);

    return view('rekodATA.show', compact('rekodATA'));
}

}
