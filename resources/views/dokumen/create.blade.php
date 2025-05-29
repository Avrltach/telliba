@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Dokumen</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('dokumen.create') }}" class="btn btn-primary mb-3">Tambah Dokumen</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokumens as $dokumen)
                <tr>
                    <td>{{ $dokumen->Title }}</td>
                    <td>{{ $dokumen->category->Name ?? '-' }}</td>
                    <td>{{ $dokumen->Description }}</td>
                    <td>
                        @if($dokumen->FilePath)
                            <a href="{{ asset('storage/' . $dokumen->FilePath) }}" target="_blank">Lihat</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dokumen.edit', $dokumen->ID) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('dokumen.destroy', $dokumen->ID) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus dokumen?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
