@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Aset Tak Alih Tanah (ATAT)</h2>

    <!-- Paparkan sebarang mesej kesilapan -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('atat.update', $atat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        

        <div class="mb-3">
            <label for="no_lot" class="form-label">No Lot</label>
            <input type="text" class="form-control" id="no_lot" name="no_lot" value="{{ old('no_lot', $atat->no_lot) }}" >
        </div>

        <div class="mb-3">
            <label for="no_hakmilik" class="form-label">No Hakmilik</label>
            <input type="text" class="form-control" id="no_hakmilik" name="no_hakmilik" value="{{ old('no_hakmilik', $atat->no_hakmilik) }}" >
        </div>

        <div class="mb-3">
            <label for="cpc" class="form-label">CPC</label>
            <input type="file" class="form-control" id="cpc" name="cpc">
            @if($atat->cpc)
                <p>Fail semasa: {{ $atat->cpc }}</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="jkr66a" class="form-label">JKR66A</label>
            <input type="file" class="form-control" id="jkr66a" name="jkr66a">
            @if($atat->jkr66a)
                <p>Fail semasa: {{ $atat->jkr66a }}</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="doc_auc" class="form-label">Doc AUC</label>
            <input type="file" class="form-control" id="doc_auc" name="doc_auc">
            @if($atat->doc_auc)
                <p>Fail semasa: {{ $atat->doc_auc }}</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Kemas Kini</button>
    </form>
</div>
@endsection
