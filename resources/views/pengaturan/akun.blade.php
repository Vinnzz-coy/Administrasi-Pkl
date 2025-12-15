@extends('layouts.app')

@section('content')
<div class="container my-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold">Pengaturan Akun</h2>
        <p class="text-muted">
            Kelola profil dan keamanan akun Anda
        </p>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">
                    Profil & Keamanan
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('pengaturan.akun.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- NIP --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ Auth::user()->nip }}"
                                   readonly>
                        </div>

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   name="nama"
                                   value="{{ old('nama', $user->nama) }}"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <p class="fw-semibold text-muted">
                            Ganti Kata Sandi (opsional)
                        </p>

                        {{-- PASSWORD LAMA --}}
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- KONFIRMASI --}}
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password"
                                   class="form-control"
                                   name="new_password_confirmation">
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary px-4">
                                <i class="fa fa-save me-1"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
