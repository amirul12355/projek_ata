@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Senarai Pengguna</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Nombor IC</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->ic_number }}</td>
                    <td>{{ $user->kategori }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Padam</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
