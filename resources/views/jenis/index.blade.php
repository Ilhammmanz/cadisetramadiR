@extends('layouts.app')

@section('title', __('manage_categories_title') . ' - POS ILHAM')

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
        --text-light: #9333ea;
        --icon-bg: #f3e8ff;
        --icon-color: #7e22ce;
        --table-head-bg: #f3e8ff;
        --table-hover-bg: #faf5ff;
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
        position: relative;
        overflow: hidden;
    }

    .custom-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.08);
    }

    .table thead th {
        background-color: var(--table-head-bg);
        color: var(--text-heading);
        font-weight: 600;
        border-bottom: 2px solid #e9d5ff;
    }

    .table tbody tr:hover {
        background-color: var(--table-hover-bg);
    }

    .btn-primary-custom {
        background: var(--primary-gradient);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: var(--radius-md);
        padding: 0.6rem 1.5rem;
        transition: var(--transition);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.3);
        color: white;
    }

    .btn-action {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-edit {
        background: #f3e8ff;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
    }

    .btn-edit:hover {
        background: #7c3aed;
        color: white;
        border-color: #7c3aed;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
        border-color: #dc2626;
    }

    .search-box {
        border: 2px solid #e9d5ff;
        border-radius: var(--radius-md);
        padding: 0.6rem 1rem;
        transition: var(--transition);
    }

    .search-box:focus-within {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="dashboard-header-banner position-relative">
        <div class="position-relative" style="z-index: 1;">
            <h2 class="fw-bold text-white mb-2 d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill fs-2"></i> {{ __('manage_categories_title') }}
            </h2>
            <p class="text-white opacity-75 mb-0">{{ __('manage_categories_subtitle') }}</p>
        </div>
        <div class="position-absolute end-0 bottom-0 opacity-15 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-tags text-white" style="font-size: 6rem;"></i>
        </div>
    </div>

    <div class="custom-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            {{-- Search Box --}}
            <form action="{{ route('jenis.index') }}" method="GET" class="flex-grow-1">
                <div class="input-group search-box">
                    <span class="input-group-text bg-transparent border-0 text-muted">
                        <i class="bi bi-search" style="color: #7c3aed;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-0 shadow-none"
                           placeholder="{{ __('search_categories') }}" value="{{ request('search') }}">
                </div>
            </form>

            {{-- Tombol Tambah --}}
            @can('create', App\Models\Jenis::class)
            <a href="{{ route('jenis.create') }}" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> {{ __('add_category') }}
            </a>
            @endcan
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">{{ __('category_number') }}</th>
                        <th style="width: 50%;">{{ __('category_name_header') }}</th>
                        <th style="width: 40%;">{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenis as $item)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}</td>
                        <td class="fw-semibold" style="color: var(--text-heading);">{{ $item->nama }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                @can('update', $item)
                                <a href="{{ route('jenis.edit', $item) }}" class="btn btn-action btn-edit">
                                    <i class="bi bi-pencil-fill"></i> {{ __('edit') }}
                                </a>
                                @endcan
                                @can('delete', $item)
                                <form action="{{ route('jenis.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete" onclick="return confirm('{{ __('confirm_delete_category') }}')">
                                        <i class="bi bi-trash-fill"></i> {{ __('delete') }}
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <p class="mb-0">{{ __('no_categories_data') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($jenis->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jenis->links() }}
        </div>
        @endif
    </div>

</div>

@endsection