<!DOCTYPE html>
<html>
<head>
    <title>Rekod Aset Tak Alih</title>
    <style>
        /* Gaya asas untuk jadual dalam PDF */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }
        
        th:nth-child(1), td:nth-child(1) { width: 3%; } /* Kod AO */
        th:nth-child(2), td:nth-child(2) { width: 5%; } /* Kod PTJ */
        th:nth-child(3), td:nth-child(3) { width: 15%; } /* Nama PTJ */
        th:nth-child(4), td:nth-child(4) { width: 5%; } /* Negeri */
        th:nth-child(5), td:nth-child(5) { width: 5%; } /* Daerah */
        th:nth-child(6), td:nth-child(6) { width: 8%; } /* Bandar */
        th:nth-child(7), td:nth-child(7) { width: 5%; } /* No Lot */
        th:nth-child(8), td:nth-child(8) { width: 5%; } /* No Hakmilik */
        th:nth-child(9), td:nth-child(9) { width: 5%; } /* Luas Tanah */
        th:nth-child(10), td:nth-child(10) { width: 8%; } /* No Lot (Lama) */
        th:nth-child(11), td:nth-child(11) { width: 8%; } /* No Hakmilik (Lama) */
        th:nth-child(12), td:nth-child(12) { width: 8%; } /* Luas Tanah (Lama) */
        th:nth-child(13), td:nth-child(13) { width: 10%; } /* Nilai Tanah JPPH */
        th:nth-child(14), td:nth-child(14) { width: 10%; } /* Nilai Bangunan JPPH */
        th:nth-child(15), td:nth-child(15) { width: 10%; } /* Nilai Tanah IGFMAS */
        th:nth-child(16), td:nth-child(16) { width: 10%; } /* Nilai Bangunan IGFMAS */
        th:nth-child(17), td:nth-child(17) { width: 10%; } /* Catatan */
    </style>
</head>
<body>
    <h1>Rekod Aset Tak Alih</h1>
    <table>
        <thead>
            <tr>
                <th>Kod AO</th>
                <th>Kod PTJ</th>
                <th>Nama PTJ</th>
                <th>Negeri</th>
                <th>Daerah</th>
                <th>Bandar</th>
                <th>No Lot</th>
                <th>No Hakmilik</th>
                <th>Luas Tanah</th>
                <th>No Lot (Lama)</th>
                <th>No Hakmilik (Lama)</th>
                <th>Luas Tanah (Lama)</th>
                <th>Nilai Tanah JPPH</th>
                <th>Nilai Bangunan JPPH</th>
                <th>Nilai Tanah IGFMAS</th>
                <th>Nilai Bangunan IGFMAS</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekod_aset as $rekod)
            <tr>
                <td>{{ $rekod->kod_ao }}</td>
                <td>{{ $rekod->kod_ptj }}</td>
                <td>{{ $rekod->nama_ptj }}</td>
                <td>{{ $rekod->negeri }}</td>
                <td>{{ $rekod->daerah }}</td>
                <td>{{ $rekod->bandar }}</td>
                <td>{{ $rekod->no_lot }}</td>
                <td>{{ $rekod->no_hakmilik }}</td>
                <td>{{ $rekod->luas_tanah }}</td>
                <td>{{ $rekod->no_lot_lama }}</td>
                <td>{{ $rekod->no_hakmilik_lama }}</td>
                <td>{{ $rekod->luas_tanah_lama }}</td>
                <td>{{ $rekod->nilai_tanah_jpph }}</td>
                <td>{{ $rekod->nilai_bangunan_jpph }}</td>
                <td>{{ $rekod->nilai_tanah_igfmas }}</td>
                <td>{{ $rekod->nilai_bangunan_igfmas }}</td>
                <td>{{ $rekod->catatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>