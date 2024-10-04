@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Senarai Aset Tak Alih (Tanah)</h1>

    <!-- Butang untuk buka modal tambah data -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAtatModal">
        Tambah Aset
    </button>

    <!-- Jadual untuk senarai ATAT -->
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Bil</th>
                <th>No Lot</th>
                <th>No Hakmilik</th>
                <th>CPC</th>
                <th>JKR66a</th>
                <th>Doc Auc</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($atat as $atat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $atat->no_lot }}</td>
                <td>{{ $atat->no_hakmilik }}</td>
                <td>{{ $atat->cpc }}</td>
                <td>{{ $atat->jkr66a }}</td>
                <td>{{ $atat->doc_auc }}</td>
                <td>
                    <!-- Butang edit -->
                    <a href="{{ route('atat.edit', $atat->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Butang delete -->
                    <form action="{{ route('atat.destroy', $atat->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Padam</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk tambah ATAT -->
<div class="modal fade" id="createAtatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Tak Alih Tanah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk tambah data -->
                <form action="{{ route('atat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="no_lot" class="form-label">No Lot</label>
                        <input type="text" class="form-control" id="no_lot" name="no_lot" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hakmilik" class="form-label">No Hakmilik</label>
                        <input type="text" class="form-control" id="no_hakmilik" name="no_hakmilik" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpc">CPC (Fail PDF):</label>
                        <input type="file" name="cpc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jkr66a">JKR66A (Fail PDF):</label>
                        <input type="file" name="jkr66a" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="doc_auc">Doc AUC (Fail PDF):</label>
                        <input type="file" name="doc_auc" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Aset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
