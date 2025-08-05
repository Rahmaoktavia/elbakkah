@extends('dashboard.layouts.main')

@section('title', 'Edit Jawaban Pertanyaan')
@section('navContactUs', 'active')

@section('content')
<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Pertanyaan & Jawaban</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.contact_us.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control bg-light" value="{{ $question->nama }}" readonly>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control bg-light" value="{{ $question->email }}" readonly>
            </div>

            <!-- Pertanyaan -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Pertanyaan</label>
                <textarea class="form-control bg-light" rows="4" readonly>{{ $question->pertanyaan }}</textarea>
            </div>

            <!-- Jawaban -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jawaban</label>
                <textarea name="jawaban" class="form-control @error('jawaban') is-invalid @enderror" rows="4">{{ old('jawaban', $question->jawaban) }}</textarea>
                @error('jawaban')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Tampilkan ke Publik -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ $question->is_published ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_published">Tampilkan ke Publik (FAQ)</label>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.contact_us.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-biru d-flex align-items-center">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>   
@endsection
