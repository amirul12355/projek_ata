@include('partials.head') <!-- header KPT -->

@include('partials.navbar') <!-- Nav KPT -->
<div class="container">
    <h1 class="mt-4">Rekod Aset Tak Alih</h1>

    <!-- Borang Penapisan -->
    <form action="{{ route('rekodATA.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label for="kod_ao">Kod AO</label>
                <select name="kod_ao" class="form-control">
                    <option value="">-- Pilih Kod AO --</option>
                    @if(!empty($kod_ao_list))
                    @foreach($kod_ao_list as $kod_ao)
                        <option value="{{ $kod_ao }}" {{ request('kod_ao') == $kod_ao ? 'selected' : '' }}>{{ $kod_ao }}</option>
                        
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2">
                <label for="kod_ptj">Kod PTJ</label>
                <select name="kod_ptj" class="form-control">
                    <option value="">-- Pilih Kod PTJ --</option>
                    @if(!empty($kod_ptj_list))
                    @foreach($kod_ptj_list as $kod_ptj)
                        <option value="{{ $kod_ptj }}" {{ request('kod_ptj') == $kod_ptj ? 'selected' : '' }}>{{ $kod_ptj }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2">
                <label for="nama_ptj">Nama PTJ</label>
                <select name="nama_ptj" class="form-control">
                    <option value="">-- Pilih Nama PTJ --</option>
                    @if(!empty($nama_ptj_list))
                    @foreach($nama_ptj_list as $nama_ptj)
                        <option value="{{ $nama_ptj }}" {{ request('nama_ptj') == $nama_ptj ? 'selected' : '' }}>{{ $nama_ptj }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2">
                <label for="negeri">Negeri</label>
                <select name="negeri" class="form-control">
                    <option value="">-- Pilih Negeri --</option>
                    @if(!empty($negeri_list))
                    @foreach($negeri_list as $negeri)
                        <option value="{{ $negeri }}" {{ request('negeri') == $negeri ? 'selected' : '' }}>{{ $negeri }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2">
                <label for="daerah">Daerah</label>
                <select name="daerah" class="form-control">
                    <option value="">-- Pilih Daerah --</option>
                    @if(!empty($daerah_list))
                    @foreach($daerah_list as $daerah)
                        <option value="{{ $daerah }}" {{ request('daerah') == $daerah ? 'selected' : '' }}>{{ $daerah }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2">
                <label for="bandar">Bandar</label>
                <select name="bandar" class="form-control">
                    <option value="">-- Pilih Bandar --</option>
                    @if(!empty($bandar_list))
                    @foreach($bandar_list as $bandar)
                        <option value="{{ $bandar }}" {{ request('bandar') == $bandar ? 'selected' : '' }}>{{ $bandar }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('rekodATA.index') }}" class="btn btn-light">Reset</a>
            </div>
        </div>
    </form>
    
    <!-- Butang Export Excel dan PDF -->
    <div class="mb-3">
        <a href="{{ route('rekodATA.export.excel') }}" class="btn btn-success">Eksport ke Excel</a>
        <a href="{{ route('rekodATA.export.pdf') }}" class="btn btn-danger">Eksport ke PDF</a>
        <!-- Butang Tambah Rekod Baru -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRekodModal">Tambah Rekod Baru</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Muat Naik Excel</button>
    </div>


    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Muat Naik Rekod Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rekodATA.import.excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih Fail Excel</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('rekodATA.download.template') }}" class="btn btn-secondary">Muat Turun Templat Excel</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Muat Naik</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tambahRekodModal" tabindex="-1" aria-labelledby="tambahRekodModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRekodModalLabel">Tambah Rekod Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rekodATA.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="kod_ao">Kod AO</label>
                    <input type="text" class="form-control" id="kod_ao" name="kod_ao" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kod_ptj">Kod PTJ</label>
                    <input type="text" class="form-control" id="kod_ptj" name="kod_ptj" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_ptj">Nama PTJ</label>
                    <input type="text" class="form-control" id="nama_ptj" name="nama_ptj" required>
                </div>
                <div class="form-group mb-3">
                    <label for="negeri">Negeri</label>
                    <input type="text" class="form-control" id="negeri" name="negeri" required>
                </div>
                <div class="form-group mb-3">
                    <label for="daerah">Daerah</label>
                    <input type="text" class="form-control" id="daerah" name="daerah" required>
                </div>
                <div class="form-group mb-3">
                    <label for="bandar">Bandar</label>
                    <input type="text" class="form-control" id="bandar" name="bandar" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_lot">No Lot</label>
                    <input type="text" class="form-control" id="no_lot" name="no_lot" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_hakmilik">No Hakmilik</label>
                    <input type="text" class="form-control" id="no_hakmilik" name="no_hakmilik" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="luas_tanah">Luas Tanah</label>
                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_lot_lama">No Lot (Lama)</label>
                    <input type="text" class="form-control" id="no_lot_lama" name="no_lot_lama" >
                </div>
                <div class="form-group mb-3">
                    <label for="no_hakmilik_lama">No Hakmilik (Lama)</label>
                    <input type="text" class="form-control" id="no_hakmilik_lama" name="no_hakmilik_lama" >
                </div>
                <div class="form-group mb-3">
                    <label for="luas_tanah_lama">Luas Tanah (Lama)</label>
                    <input type="text" class="form-control" id="luas_tanah_lama" name="luas_tanah_lama" >
                </div>
                <div class="form-group mb-3">
                    <label for="nilai_tanah_jpph">Nilai Tanah JPPH</label>
                    <input type="text" class="form-control" id="nilai_tanah_jpph" name="nilai_tanah_jpph" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nilai_bangunan_jpph">Nilai Bangunan JPPH</label>
                    <input type="text" class="form-control" id="nilai_bangunan_jpph" name="nilai_bangunan_jpph" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nilai_tanah_igfmas">Nilai Tanah IGFMAS</label>
                    <input type="text" class="form-control" id="nilai_tanah_igfmas" name="nilai_tanah_igfmas" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nilai_bangunan_igfmas">Nilai Bangunan IGFMAS</label>
                    <input type="text" class="form-control" id="nilai_bangunan_igfmas" name="nilai_bangunan_igfmas" required>
                </div>
                <div class="form-group mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Rekod</button>
    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Jadual Paparan Data Rekod Aset -->
    <table class="table table-bordered">
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

    
    <div class="d-flex justify-content-center">
        {{ $rekod_aset->links('pagination::bootstrap-4') }}
    </div>

    
    

</div>
@include('partials.footer') <!-- footer KPT -->