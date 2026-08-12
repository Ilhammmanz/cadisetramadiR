@extends('layouts.app')

@section('title', __('add_new_category') . ' - POS ILHAM')

@section('content')

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #5b21b6 0%, #7c3aed 50%, #9333ea 100%);
        --bg-slate: #f5f3ff;
        --card-bg: #ffffff;
        --card-border: #e9d5ff;
        --text-heading: #2e1065;
        --text-body: #4c1d95;
        --text-muted: #6b21a8;
        --radius-lg: 20px;
        --radius-md: 14px;
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%) !important;
        color: var(--text-body) !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .dashboard-header-banner {
        background: var(--primary-gradient) !important;
        border-radius: var(--radius-lg);
        padding: 2.5rem 2.25rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(124, 58, 237, 0.15);
    }

    .custom-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.08);
    }

    .form-control {
        border: 2px solid #e9d5ff;
        border-radius: var(--radius-md);
        padding: 0.75rem 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-label {
        color: var(--text-heading);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .btn-primary-custom {
        background: var(--primary-gradient);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: var(--radius-md);
        padding: 0.75rem 2rem;
        transition: var(--transition);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.3);
        color: white;
    }

    .btn-secondary-custom {
        background: #f3e8ff;
        border: 1px solid #ddd6fe;
        color: #7c3aed;
        font-weight: 600;
        border-radius: var(--radius-md);
        padding: 0.75rem 2rem;
        transition: var(--transition);
    }

    .btn-secondary-custom:hover {
        background: #7c3aed;
        color: white;
        border-color: #7c3aed;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="dashboard-header-banner position-relative">
        <div class="position-relative" style="z-index: 1;">
            <h2 class="fw-bold text-white mb-2 d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill fs-2"></i> {{ __('add_new_category') }}
            </h2>
            <p class="text-white opacity-75 mb-0">{{ __('add_new_category_subtitle') }}</p>
        </div>
    </div>

    <div class="custom-card p-4">
        <form action="{{ route('jenis.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama" class="form-label">{{ __('category_name_label') }}</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                       id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="{{ __('category_name_placeholder') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('jenis.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left"></i> {{ __('back') }}
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-save"></i> {{ __('save') }}
                </button>
            </div>
        </form>
    </div>

</div>

@endsection