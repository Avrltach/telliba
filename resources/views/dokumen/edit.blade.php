@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Dokumen</h2>

    <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="Title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="Title" value="{{ old('Title') }}" required>
        </div>

        <div class="mb-3">
            <label for="CategoryID" class="form-label">Kategori</label>
            <select class="form-select" name="CategoryID" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->ID }}">{{ $category->Name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="Description">{{ old('Description') }}</textar
