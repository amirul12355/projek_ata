@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengguna</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ic_number">Nombor IC</label>
            <input type="text" name="ic_number" id="ic_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Kata laluan</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="KPT">KPT</option>
                <option value="PUO">PUO</option>
                <option value="KKSS">KKSS</option>
                <!-- Tambah kategori lain jika perlu -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Tambah Pengguna</button>
    </form>
</div>
@endsection
