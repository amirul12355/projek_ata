<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekodAset;
use App\Exports\RekodAsetExport;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;


class RekodAsetController extends Controller
{
    // Fungsi untuk memaparkan senarai rekod
    public function index()
    {
        //$rekod_aset = RekodAset::all(); // Pembolehubah dengan nama yang betul
        $rekod_aset = RekodAset::paginate(10);
        return view('rekodATA.index', compact('rekod_aset')); // Gunakan nama pembolehubah yang sama
    }

    // Fungsi untuk memaparkan borang tambah rekod
    public function create()
    {
        return view('rekodATA.create');
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
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
            
            'nilai_tanah_jpph' => 'required|numeric', // Tambahkan 'numeric' untuk validasi
            'nilai_bangunan_jpph' => 'required|numeric',
            'nilai_tanah_igfmas' => 'required|numeric',
            'nilai_bangunan_igfmas' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        RekodAset::create($validatedData);
        return redirect()->route('rekodATA.index')->with('success', 'Rekod berjaya disimpan');
    }

    // Fungsi untuk eksport data ke Excel
    public function exportExcel()
    {
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set tajuk untuk kolum
        $sheet->setCellValue('A1', 'Kod AO');
        $sheet->setCellValue('B1', 'Kod PTJ');
        $sheet->setCellValue('C1', 'Nama PTJ');
        $sheet->setCellValue('D1', 'Negeri');
        $sheet->setCellValue('E1', 'Daerah');
        $sheet->setCellValue('F1', 'Bandar');
        $sheet->setCellValue('G1', 'No Lot');
        $sheet->setCellValue('H1', 'No Hakmilik');
        $sheet->setCellValue('I1', 'Luas Tanah');
        $sheet->setCellValue('J1', 'No Lot (Lama)');
        $sheet->setCellValue('K1', 'No Hakmilik (Lama)');
        $sheet->setCellValue('L1', 'Luas Tanah (Lama)');
        $sheet->setCellValue('M1', 'Nilai Tanah JPPH');
        $sheet->setCellValue('N1', 'Nilai Bangunan JPPH');
        $sheet->setCellValue('O1', 'Nilai Tanah IGFMAS');
        $sheet->setCellValue('P1', 'Nilai Bangunan IGFMAS');
        $sheet->setCellValue('Q1', 'Catatan');

        // Ambil data dari model
        $rekod_aset = RekodAset::all();
        $row = 2; // Bermula dari baris kedua (baris pertama untuk tajuk)

        foreach ($rekod_aset as $rekod) {
            $sheet->setCellValue('A'.$row, $rekod->kod_ao);
            $sheet->setCellValue('B'.$row, $rekod->kod_ptj);
            $sheet->setCellValue('C'.$row, $rekod->nama_ptj);
            $sheet->setCellValue('D'.$row, $rekod->negeri);
            $sheet->setCellValue('E'.$row, $rekod->daerah);
            $sheet->setCellValue('F'.$row, $rekod->bandar);
            $sheet->setCellValue('G'.$row, $rekod->no_lot);
            $sheet->setCellValue('H'.$row, $rekod->no_hakmilik);
            $sheet->setCellValue('I'.$row, $rekod->luas_tanah);
            $sheet->setCellValue('J'.$row, $rekod->no_lot_lama);
            $sheet->setCellValue('K'.$row, $rekod->no_hakmilik_lama);
            $sheet->setCellValue('L'.$row, $rekod->luas_tanah_lama);
            $sheet->setCellValue('M'.$row, $rekod->nilai_tanah_jpph);
            $sheet->setCellValue('N'.$row, $rekod->nilai_bangunan_jpph);
            $sheet->setCellValue('O'.$row, $rekod->nilai_tanah_igfmas);
            $sheet->setCellValue('P'.$row, $rekod->nilai_bangunan_igfmas);
            $sheet->setCellValue('Q'.$row, $rekod->catatan);
            $row++;
        }

        // Tulis ke fail Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'rekod_aset.xlsx';

        // Simpan dan muat turun fail Excel
        $filePath = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($filePath);

        return Response::download($filePath, $fileName)->deleteFileAfterSend(true);
    }



   
    public function exportPdf()
    {
        $rekod_aset = RekodAset::all();
        $pdf = PDF::loadView('rekodATA.pdf', compact('rekod_aset'))->setPaper('a4', 'landscape');

        return $pdf->download('rekod_aset.pdf');
    }




    public function importExcel(Request $request)
    {
        // Validasi fail yang dimuat naik
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses fail Excel yang dimuat naik
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $worksheet = $spreadsheet->getActiveSheet();

        // Loop melalui setiap baris dalam Excel
        foreach ($worksheet->getRowIterator(2) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $rowData = [];
            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Simpan data ke pangkalan data (sesuaikan dengan struktur data)
            RekodAset::create([
                'kod_ao' => $rowData[0],
                'kod_ptj' => $rowData[1],
                'nama_ptj' => $rowData[2],
                'negeri' => $rowData[3],
                'daerah' => $rowData[4],
                'bandar' => $rowData[5],
                'no_lot' => $rowData[6],
                'no_hakmilik' => $rowData[7],
                'luas_tanah' => $rowData[8],
                'no_lot_lama' => $rowData[9],
                'no_hakmilik_lama' => $rowData[10],
                'luas_tanah_lama' => $rowData[11],
                'nilai_tanah_jpph' => $rowData[12],
                'nilai_bangunan_jpph' => $rowData[13],
                'nilai_tanah_igfmas' => $rowData[14],
                'nilai_bangunan_igfmas' => $rowData[15],
                'catatan' => $rowData[16],
            ]);
        }

        return redirect()->route('rekodATA.index')->with('success', 'Data berjaya dimuat naik dari Excel.');
    }


    public function downloadTemplate()
   {
       $filePath = public_path('templates/rekod_aset_template.xlsx');
       return response()->download($filePath);
   }


}
