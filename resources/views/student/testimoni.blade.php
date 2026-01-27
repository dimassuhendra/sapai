@extends('layouts.student.master')

@section('title', 'Beri Testimoni')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Beri Testimoni</h4>
            <p class="text-muted">Bagikan pengalaman belajar Anda untuk membantu kami menjadi lebih baik.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <form action="{{ route('student.testimoni.store') }}" method="POST">
                    @csrf
                    <div class="text-center mb-4">
                        <h5 class="fw-bold">Bagaimana pengalaman Anda?</h5>
                        <p class="text-muted small">Berikan rating bintang dan ulasan singkat</p>

                        <div class="rating-css mt-3">
                            <div class="star-icon">
                                {{-- Kita urutkan terbalik dari 5 ke 1 agar row-reverse CSS bekerja dengan benar --}}
                                @for($i = 5; $i >= 1; $i--)
                                <input type="radio" value="{{ $i }}" name="rating" id="rating{{ $i }}"
                                    {{ (isset($myTestimoni) && $myTestimoni->rating == $i) ? 'checked' : ($i == 5 && !isset($myTestimoni) ? 'checked' : '') }}>
                                <label for="rating{{ $i }}" class="fas fa-star"></label>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Ulasan Anda</label>
                        <textarea name="testimoni" class="form-control rounded-4 p-3" rows="5"
                            placeholder="Tuliskan kesan dan pesan Anda selama mengikuti program belajar..."
                            required>{{ $myTestimoni->testimoni ?? '' }}</textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn rounded-pill text-white py-2 fw-bold shadow-sm" style="background-color: var(--student-secondary);">
                            <i class="fas fa-paper-plane me-2"></i> {{ isset($myTestimoni) ? 'Perbarui Testimoni' : 'Kirim Testimoni' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 text-white shadow-sm rounded-4 p-4" style="background-color: var(--student-secondary);">
                <i class="fas fa-quote-left fa-3x mb-3 opacity-50"></i>
                <h5 class="fw-bold">Kenapa testimoni itu penting?</h5>
                <p class="small opacity-75">Ulasan Anda sangat berarti bagi calon siswa lain untuk meyakinkan mereka memulai perjalanan belajar. Selain itu, masukan Anda membantu pengajar meningkatkan kualitas materi.</p>
                <hr class="border-white opacity-25">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle p-2 me-3" style="color: var(--student-secondary);">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="small fw-bold">Terima kasih atas kontribusi Anda!</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Styling Rating Bintang */
    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 40px;
        text-shadow: 1px 1px 0 #ffe400;
        cursor: pointer;
        color: #ddd;
    }

    .rating-css input:checked~label {
        color: #ddd;
    }

    .rating-css label:hover,
    .rating-css label:hover~label,
    .rating-css input:checked~label,
    .rating-css input:checked+label~label {
        color: #ffe400;
    }

    /* Membalik urutan agar hover dari kiri ke kanan */
    .star-icon {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }
</style>
@endpush
@endsection