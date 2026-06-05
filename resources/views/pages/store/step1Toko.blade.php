<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Toko - Rentalin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        body { background:#F5F7FA; font-family:'Inter', 'Inter', sans-serif; }

        /* ── Page wrapper ── */
        .page-wrap { width:100%; max-width:1289px; margin:0 auto; padding:28px 40px 60px; box-sizing:border-box; }

        /* ── Page header ── */
        .page-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
        .btn-back { display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .btn-back img { width:36px; height:36px; display:block; }
        .page-title { font-size:20px; font-weight:700; color:#1E1E1E; margin:0; }

        /* ── Stepper ── */
        .stepper { display:flex; align-items:center; margin-bottom:32px; }
        .step-item { display:flex; flex-direction:column; align-items:center; flex-shrink:0; }
        .step-dot {
            width:44px; height:44px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:16px;
        }
        .step-dot.active  { background:#34699A; color:#fff; }
        .step-dot.inactive{ background:#E5E7EB; border:1px solid #D1D5DB; color:#9CA3AF; }
        .step-label { font-size:12px; margin-top:6px; white-space:nowrap; color:#9CA3AF; }
        .step-label.active { font-weight:600; color:#34699A; }
        .step-line { flex:1; height:2px; background:#D1D5DB; align-self:flex-start; margin-top:22px; }
        .step-line.done { background:#34699A; }

        /* ── Form card ── */
        .form-card {
            background:#fff;
            border-radius:14px;
            box-shadow:0 2px 20px rgba(0,0,0,0.07);
            padding:40px 48px;
        }

        /* ── Error box ── */
        .error-box { background:#FEF2F2; color:#B91C1C; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:13px; }
        .error-box ul { margin:0; padding-left:16px; }

        /* ── Form grid & groups ── */
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:28px; margin-bottom:24px; }
        .form-group  { display:flex; flex-direction:column; gap:8px; }
        .form-group.full { margin-bottom:24px; }

        .form-label { font-size:14px; font-weight:500; color:#374151; }
        .form-label-optional { font-weight:400; color:#9CA3AF; }

        .form-input {
            width:100%; box-sizing:border-box;
            border:1px solid #D1D5DB; border-radius:8px;
            padding:13px 16px; font-size:14px; color:#374151;
            font-family:inherit; outline:none;
            transition:border-color .2s, box-shadow .2s;
            background:#fff;
        }
        .form-input::placeholder { color:#9CA3AF; }
        .form-input:focus { border-color:#34699A; box-shadow:0 0 0 3px rgba(52,105,154,.1); }

        .form-textarea { resize:vertical; min-height:110px; }

        .field-error { font-size:12px; color:#EF4444; }

        /* ── Submit ── */
        .form-footer { text-align:center; margin-top:40px; }
        .btn-submit {
            background:#34699A; color:#fff;
            font-family:inherit; font-weight:600; font-size:15px;
            padding:14px 64px; border-radius:8px; border:none;
            cursor:pointer; transition:background .2s;
        }
        .btn-submit:hover { background:#2b5a87; }
    </style>
</head>
<body>

    @include('layouts.partials.navbar')

    <main class="page-wrap">

        {{-- Header --}}
        <div class="page-header">
            <a href="{{ route('store.bukaToko') }}" class="btn-back">
                <img src="{{ asset('assets/icons/arrow-left-circle.png') }}" alt="Kembali">
            </a>
            <h1 class="page-title">Informasi Toko</h1>
        </div>

        {{-- Stepper --}}
        <div style="margin-bottom:32px;">
            <div style="display:flex; align-items:center;">
                <div class="step-dot active">1</div>
                <div class="step-line done"></div>
                <div class="step-dot inactive">2</div>
                <div class="step-line"></div>
                <div class="step-dot inactive">3</div>
            </div>
            <div style="display:flex; align-items:flex-start; margin-top:8px;">
                <span class="step-label active" style="width:44px; text-align:center;">Info Toko</span>
                <div style="flex:1;"></div>
                <span class="step-label" style="width:44px; text-align:center;">Verifikasi</span>
                <div style="flex:1;"></div>
                <span class="step-label" style="width:44px; text-align:center;">Selesai</span>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="form-card">

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('store.step1Toko.simpan') }}" method="POST">
                @csrf

                {{-- Nama Toko & Alamat Toko --}}
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-input"
                               placeholder="Masukkan nama toko"
                               value="{{ old('nama_toko', $data['nama_toko'] ?? '') }}">
                        @error('nama_toko') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat Toko</label>
                        <input type="text" name="alamat_toko" class="form-input"
                               placeholder="Masukkan alamat toko"
                               value="{{ old('alamat_toko', $data['alamat_toko'] ?? '') }}">
                        @error('alamat_toko') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group full">
                    <label class="form-label">
                        Deskripsi Toko <span class="form-label-optional">(Opsional)</span>
                    </label>
                    <textarea name="deskripsi" class="form-input form-textarea"
                              placeholder="Ceritakan sedikit tentang toko kamu...">{{ old('deskripsi', $data['deskripsi'] ?? '') }}</textarea>
                </div>

                {{-- No Telepon --}}
                <div class="form-grid-2" style="margin-bottom:0;">
                    <div class="form-group">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-input"
                               placeholder="Masukkan no telepon"
                               value="{{ old('no_telepon', $data['no_telepon'] ?? '') }}">
                        @error('no_telepon') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">Lanjutkan</button>
                </div>

            </form>
        </div>

    </main>

    @include('layouts.partials.footer')

</body>
</html>