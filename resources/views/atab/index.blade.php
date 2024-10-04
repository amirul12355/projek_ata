@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Senarai Rekod ATAB</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Butang untuk membuka modal tambah data -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAtabModal">Tambah Rekod ATAB</button>
            <br><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bil.</th>
                    <th>No. Lot</th>
                    <th>No. Hakmilik</th>
                    <th>JPPH</th>
                    <th>SAP</th>
                    <th>Geran</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($atab as $record)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $record->no_lot }}</td>
                        <td>{{ $record->no_hakmilik }}</td>
                        <td>
                            @if ($record->jpph)
                                <a href="{{ asset('storage/' . $record->jpph) }}" target="_blank">Muat Turun JPPH</a>
                            @else
                                Tiada JPPH
                            @endif
                        </td>
                        <td>
                            @if ($record->sap)
                                <a href="{{ asset('storage/' . $record->sap) }}" target="_blank">Muat Turun SAP</a>
                            @else
                                Tiada SAP
                            @endif
                        </td>
                        <td>
                            @if ($record->geran)
                                <a href="{{ asset('storage/' . $record->geran) }}" target="_blank">Muat Turun Geran</a>
                            @else
                                Tiada Geran
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('atab.edit', $record->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('atab.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Adakah anda pasti?')">Padam</button>
                            </form>

                            <!-- Butang untuk membuka modal "Lain-lain" -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#lainLainModal{{ $record->bil }}">
                                Lain-lain
                            </button>

                            <!-- Panggil modal di sini -->
                            @include('modals', ['record' => $record])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tiada rekod.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal untuk tambah rekod ATAB -->
    <div class="modal fade" id="tambahAtabModal" tabindex="-1" aria-labelledby="tambahAtabModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAtabModalLabel">Tambah Rekod ATAB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('atab.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_lot" class="form-label">No Lot</label>
                            <input type="text" name="no_lot" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hakmilik" class="form-label">No Hakmilik</label>
                            <input type="text" name="no_hakmilik" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jpph" class="form-label">JPPH</label>
                            <input type="file" name="jpph" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sap" class="form-label">S&P</label>
                            <input type="file" name="sap" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="geran" class="form-label">Geran</label>
                            <input type="file" name="geran" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection
