@include('layouts.welcome')
@extends('layouts.master')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
    <link rel="icon" type="image/png" href="{{ asset('img/BUK.jpeg') }}">
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="icon" type="image/png" href="{{ asset('img/BUK.jpeg') }}">
<style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Sesuaikan dengan kebutuhan Anda */
    }

    .form-group label {
        width: 150px; /* Sesuaikan dengan lebar label Anda */
        margin-right: 20px; /* Sesuaikan dengan jarak antara label dan input */
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        flex: 1;
    }
    .custom-link-wrapper {
        margin-bottom: 20px; /* Menambahkan jarak ke bawah */
        text-align: left; /* Mengatur posisi tombol ke kanan */
    }

    .custom-link-wrapper .btn {
        margin-top: 10px; /* Menambahkan jarak dari atas */

    }
</style>
<div class="custom-link-wrapper ";>
    <a href="/buku/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
</div>
@endpush
@section('content')
<div class="card-body">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('loginEror'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginEror') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <form action="/buku/tambah" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="kategori_id" class="text-primary font-weight-bold">Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="Judul" class="text-primary font-weight-bold"> Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
            @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="kode_buku" class="text-primary font-weight-bold"> Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku') }}">
            @error('kode_buku')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="penulis" class="text-primary font-weight-bold">Penulis</label>
            <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}">
            @error('penulis')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="penerbit" class="text-primary font-weight-bold">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
            @error('penerbit')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="tahun_terbit" class="text-primary font-weight-bold">Tahun Terbit</label>
            <input type="text" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}">
            {{-- @error('tahun_terbit')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
        </div>

        <div class="form-group mb-3">
            <label for="deskripsi" class="text-primary font-weight-bold">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="2">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="stok" class="text-primary font-weight-bold">Total buku</label>
            <input type="text" name="total_buku" value="{{ old('total_buku') }}" class="form-control">
            @error('total_buku')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="stok" class="text-primary font-weight-bold">Stok</label>
            <input type="text" name="stok" value="{{ old('stok') }}" class="form-control">
            @error('stok')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar" class="text-primary font-weight-bold">Tambah Sampul Buku</label>
            <div class="custom-file">
                <input type="file" name="gambar" id="gambar" value="{{ old('gambar') }}">
            </div>
            @error('gambar')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">

            <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
        </div>
    </form>
</div>
</div>

<script>
    $('#multiselect').select2({
        allowClear: true
    });
</script>

<script>
    // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
    changePageTitle("Halaman Tambah Buku");
</script>
@endsection
