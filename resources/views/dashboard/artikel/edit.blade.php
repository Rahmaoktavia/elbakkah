@extends('dashboard.layouts.main')

@section('title', 'Edit Artikel')
@section('navArtikel', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Artikel</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Artikel -->
            <div class="mb-3">
                <label for="judul_artikel" class="form-label fw-semibold">Judul Artikel</label>
                <input type="text" class="form-control @error('judul_artikel') is-invalid @enderror"
                       name="judul_artikel" id="judul_artikel"
                       placeholder="Masukkan judul artikel"
                       value="{{ old('judul_artikel', $artikel->judul_artikel) }}">
                @error('judul_artikel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Terbit -->
            <div class="mb-3">
                <label for="tanggal_terbit" class="form-label fw-semibold">Tanggal Terbit</label>
                <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror"
                       name="tanggal_terbit" id="tanggal_terbit"
                       value="{{ old('tanggal_terbit', $artikel->tanggal_terbit) }}">
                @error('tanggal_terbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Isi Artikel -->
            <div class="mb-3">
                <label for="isi_artikel" class="form-label fw-semibold">Isi Artikel</label>
                <textarea class="form-control @error('isi_artikel') is-invalid @enderror"
                          name="isi_artikel" id="isi_artikel" rows="10"
                          placeholder="Tulis konten artikel...">{{ old('isi_artikel', $artikel->isi_artikel) }}</textarea>
                @error('isi_artikel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gambar Sampul -->
            <div class="mb-3">
                <label for="gambar_sampul" class="form-label fw-semibold">Gambar Sampul</label>
                @if($artikel->gambar_sampul)
                    <div class="mt-2 mb-3">
                        <img src="{{ asset('img/' . $artikel->gambar_sampul) }}" alt="Gambar Sampul" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('gambar_sampul') is-invalid @enderror" name="gambar_sampul" id="gambar_sampul">
                @error('gambar_sampul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-biru d-flex align-items-center">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan script CKEditor -->
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

<script>
tinymce.init({
  selector: '#isi_artikel',
  height: 300,
  menubar: true,
  plugins: 'lists link image code table',
  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
  statusbar: false,
  branding: false,
  skin_url: '{{ asset("tinymce/skins/ui/oxide") }}',
  content_css: '{{ asset("tinymce/skins/content/default/content.min.css") }}'
});
</script>

@endsection
