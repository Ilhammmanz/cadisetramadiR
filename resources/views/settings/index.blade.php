@extends('layouts.app')

@section('title', __('settings') . ' - POS System')

@section('content')

<style>
    /* ==========================================
       CSS VARIABLES (HIERARCHY & PURPLE THEME)
       ========================================== */
    :root {
        /* Gradient Banner */
        --primary-gradient: linear-gradient(135deg, #5b21b6 0%, #7c3aed 50%, #9333ea 100%);
        
        /* Background & Surface */
        --bg-slate: #f5f3ff;
        --card-bg: #ffffff;
        --card-border: #e9d5ff;

        /* HIERARCHY WARNA TEKS (Dari yang paling utama sampai sekunder) */
        --text-heading: #2e1065;   /* Level 1: Judul Utama & Angka Penting (Sangat Kontras) */
        --text-body: #4c1d95;      /* Level 2: Teks Isian & Nama Produk */
        --text-muted: #6b21a8;     /* Level 3: Label, Subtitle & Keterangan Tambahan */
        --text-light: #9333ea;     /* Level 4: Aksesori & Elemen Pendukung */

        /* Ikon & Accent */
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

    /* HEADER BANNER - LEVEL 1 VISUAL IMPORTANCE */
    .dashboard-header-banner {
        background: var(--primary-gradient) !important;
        border-radius: var(--radius-lg);
        padding: 2.5rem 2.25rem;
        color: #ffffff !important;
        box-shadow: 0 10px 25px -5px rgba(124, 58, 237, 0.35);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header-banner::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -8%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        pointer-events: none;
    }

    .date-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* WADAH & IKON SERBA UNGU - VISUAL ANCHOR */
    .icon-box-modern {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
        transition: var(--transition);
        background-color: var(--icon-bg) !important;
        color: var(--icon-color) !important;
        border: 1px solid var(--card-border);
    }

    .icon-box-modern i {
        color: var(--icon-color) !important;
    }

    /* CARDS STRUCTURE */
    .dashboard-card {
        border-radius: var(--radius-md);
        border: 1px solid var(--card-border) !important;
        background: var(--card-bg) !important;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(109, 40, 217, 0.04);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(124, 58, 237, 0.12);
        border-color: #a855f7 !important;
    }

    .card-top-accent {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient) !important;
    }

    /* Toggle Switch */
    .toggle-switch {
        position: relative;
        width: 56px;
        height: 30px;
        background: #e9d5ff;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .toggle-switch.active {
        background: linear-gradient(135deg, #7c3aed 0%, #9333ea 100%);
    }

    .toggle-switch::after {
        content: '';
        position: absolute;
        top: 4px;
        left: 4px;
        width: 22px;
        height: 22px;
        background: #ffffff;
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .toggle-switch.active::after {
        left: 30px;
    }

    /* Back Button */
    .btn-back {
        background: var(--primary-gradient) !important;
        color: #ffffff !important;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    /* Form Styles */
    .form-label {
        color: var(--text-heading);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control {
        border-color: var(--card-border) !important;
        padding: 0.75rem;
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: var(--icon-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
    }

    .form-select {
        border-color: var(--card-border) !important;
        padding: 0.75rem;
        border-radius: 10px;
    }

    .form-select:focus {
        border-color: var(--icon-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
    }


</style>

<div class="container py-4" style="padding-top: 5rem;">

    {{-- HEADER BANNER --}}
    <div class="dashboard-header-banner mb-4">
        <div class="row align-items-center g-3 position-relative" style="z-index: 1;">
            <div class="col-lg-7">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <div class="date-badge">
                        <i class="bi bi-gear"></i>
                        <span>{{ __('settings') }}</span>
                    </div>
                </div>
                <h1 class="fw-bold text-white mb-2 fs-2">
                    {{ __('app_settings') }}
                </h1>
                <p class="text-white-50 mb-0 fs-6">{{ __('settings_subtitle') }}</p>
            </div>
            <div class="col-lg-5 text-lg-end">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>{{ __('back_to_dashboard') }}</span>
                </a>
            </div>
        </div>
    </div>

    {{-- SINGLE FORM FOR ALL SETTINGS --}}
    <form action="{{ route('settings.update') }}" method="POST" id="settingsForm">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- APPEARANCE SETTINGS --}}
            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-top-accent"></div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box-modern me-3">
                                <i class="bi bi-translate"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0" style="color: var(--text-heading);">{{ __('change_language') }}</h4>
                                <span class="text-muted small" style="color: var(--text-muted);">{{ __('select_language') }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="language" class="form-label fw-semibold" style="color: var(--text-heading);">{{ __('language') }}</label>
                            <select name="language" id="language" class="form-select">
                                <option value="id" {{ $user->language === 'id' ? 'selected' : '' }}>Indonesia</option>
                                <option value="en" {{ $user->language === 'en' ? 'selected' : '' }}>English</option>
                                <option value="ja" {{ $user->language === 'ja' ? 'selected' : '' }}>日本語 (Japanese)</option>
                                <option value="zh" {{ $user->language === 'zh' ? 'selected' : '' }}>中文 (Chinese)</option>
                                <option value="ar" {{ $user->language === 'ar' ? 'selected' : '' }}>العربية (Arabic)</option>
                                <option value="fr" {{ $user->language === 'fr' ? 'selected' : '' }}>Français (French)</option>
                                <option value="de" {{ $user->language === 'de' ? 'selected' : '' }}>Deutsch (German)</option>
                                <option value="es" {{ $user->language === 'es' ? 'selected' : '' }}>Español (Spanish)</option>
                            </select>
                            <small class="text-muted mt-2 d-block">Current: {{ app()->getLocale() }}</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NOTIFICATION SETTINGS --}}
            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-top-accent"></div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box-modern me-3">
                                <i class="bi bi-bell-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0" style="color: var(--text-heading);">{{ __('notification_settings') }}</h4>
                                <span class="text-muted small" style="color: var(--text-muted);">{{ __('at_preferences') }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between py-3 px-3 rounded-3 mb-2" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1" style="color: var(--text-heading);">{{ __('notification_email') }}</div>
                                    <div class="small" style="color: var(--text-muted);">{{ __('receive_email_notification') }}</div>
                                </div>
                                <div class="ms-3 flex-shrink-0">
                                    <div class="toggle-switch {{ $user->email_notifications ? 'active' : '' }}" onclick="toggleSwitch(this)">
                                        <input type="checkbox" name="email_notifications" value="1" {{ $user->email_notifications ? 'checked' : '' }} hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between py-3 px-3 rounded-3 mb-2" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1" style="color: var(--text-heading);">{{ __('notification_sales') }}</div>
                                    <div class="small" style="color: var(--text-muted);">{{ __('alert_new_sales') }}</div>
                                </div>
                                <div class="ms-3 flex-shrink-0">
                                    <div class="toggle-switch {{ $user->sales_notifications ? 'active' : '' }}" onclick="toggleSwitch(this)">
                                        <input type="checkbox" name="sales_notifications" value="1" {{ $user->sales_notifications ? 'checked' : '' }} hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between py-3 px-3 rounded-3" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1" style="color: var(--text-heading);">{{ __('notification_stock') }}</div>
                                    <div class="small" style="color: var(--text-muted);">{{ __('alert_low_stock') }}</div>
                                </div>
                                <div class="ms-3 flex-shrink-0">
                                    <div class="toggle-switch {{ $user->stock_notifications ? 'active' : '' }}" onclick="toggleSwitch(this)">
                                        <input type="checkbox" name="stock_notifications" value="1" {{ $user->stock_notifications ? 'checked' : '' }} hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SAVE BUTTON --}}
            <div class="col-12">
                <div class="card dashboard-card p-4">
                    <div class="text-center mb-4">
                        <div class="icon-box-modern mx-auto mb-3" style="display: inline-flex;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: var(--text-heading);">{{ __('save_changes') }}</h4>
                        <p class="text-muted" style="color: var(--text-muted);">{{ __('save_all_settings') }}</p>
                    </div>

                    <button type="submit" class="btn btn-back w-100 py-3">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ __('save_all_settings') }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- SYSTEM INFO --}}
    <div class="row g-4">
        <div class="col-12">
            <div class="card dashboard-card h-100">
                <div class="card-top-accent"></div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box-modern me-3">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0" style="color: var(--text-heading);">{{ __('system_info') }}</h4>
                            <span class="text-muted small" style="color: var(--text-muted);">{{ __('system_details') }}</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="small text-muted mb-1" style="color: var(--text-muted);">{{ __('version') }}</div>
                                <div class="fw-bold" style="color: var(--text-heading);">v1.0.0</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="small text-muted mb-1" style="color: var(--text-muted);">{{ __('laravel') }}</div>
                                <div class="fw-bold" style="color: var(--text-heading);">12.56.0</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="small text-muted mb-1" style="color: var(--text-muted);">{{ __('php') }}</div>
                                <div class="fw-bold" style="color: var(--text-heading);">8.4.11</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: var(--icon-bg); border: 1px solid var(--card-border);">
                                <div class="small text-muted mb-1" style="color: var(--text-muted);">{{ __('database') }}</div>
                                <div class="fw-bold" style="color: var(--text-heading);">MySQL</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleSwitch(element) {
        element.classList.toggle('active');
        const checkbox = element.querySelector('input');
        checkbox.checked = !checkbox.checked;
    }

    // Handle language select
    document.getElementById('language').addEventListener('change', function() {
        console.log('Language changed to:', this.value);
    });
</script>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection