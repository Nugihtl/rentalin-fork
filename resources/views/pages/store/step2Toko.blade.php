<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Toko - Rentalin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        body { background:#F5F7FA; font-family:'Plus Jakarta Sans', 'Inter', sans-serif; }

        /* ── Page wrapper ── */
        .page-wrap { width:100%; max-width:1289px; margin:0 auto; padding:28px 40px 60px; box-sizing:border-box; }

        /* ── Page header ── */
        .page-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
        .btn-back { display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .btn-back img { width:36px; height:36px; display:block; }
        .page-title { font-size:20px; font-weight:700; color:#1E1E1E; margin:0; }

        /* ── Stepper ── */
        .stepper-wrap { margin-bottom:32px; }
        .stepper-dots {
            position:relative; display:flex;
            justify-content:space-between; align-items:center;
            margin-bottom:8px;
        }
        .stepper-dots::before {
            content:''; position:absolute;
            top:50%; left:22px; right:22px;
            height:2px; background:#D1D5DB;
            transform:translateY(-50%); z-index:0;
        }
        .stepper-line-done {
            position:absolute; top:50%; left:22px;
            height:2px; background:#34699A;
            transform:translateY(-50%); z-index:0;
        }
        .step-dot {
            position:relative; z-index:1;
            width:44px; height:44px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:16px; flex-shrink:0;
        }
        .step-dot.active  { background:#34699A; color:#fff; }
        .step-dot.done    { background:#E5E7EB; border:1px solid #D1D5DB; color:#9CA3AF; }
        .step-dot.inactive{ background:#E5E7EB; border:1px solid #D1D5DB; color:#9CA3AF; }
        .stepper-labels { display:flex; justify-content:space-between; }
        .step-label { width:44px; text-align:center; font-size:12px; color:#9CA3AF; white-space:nowrap; display:inline-block; }
        .step-label.active { font-weight:600; color:#34699A; }

        /* ── Privacy banner ── */
        .privacy-banner {
            background:#DBEAFE; border-left:4px solid #3B82F6;
            padding:14px 18px; border-radius:8px;
            margin-bottom:28px; font-size:14px; color:#1E40AF;
        }

        /* ── Form card ── */
        .form-card {
            background:#fff;
            border-radius:14px;
            box-shadow:0 2px 20px rgba(0,0,0,0.07);
            padding:40px 48px;
        }
        .form-section-title { font-size:16px; font-weight:700; color:#1E1E2E; margin:0 0 20px; }

        /* ── Error box ── */
        .error-box { background:#FEF2F2; color:#B91C1C; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:13px; }
        .error-box ul { margin:0; padding-left:16px; }

        /* ── Form grid & groups ── */
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:28px; margin-bottom:24px; }
        .form-group  { display:flex; flex-direction:column; gap:8px; }

        .form-label { font-size:14px; font-weight:500; color:#374151; }

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

        .field-error { font-size:12px; color:#EF4444; }

        /* ── Upload area ── */
        .upload-area {
            border:2px dashed #93C5FD; border-radius:10px;
            padding:32px 16px; text-align:center;
            background:#F0F7FF; cursor:pointer; position:relative;
        }
        .upload-area input[type=file] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
        .upload-icon { font-size:2rem; color:#93C5FD; margin-bottom:8px; }
        .upload-title { font-weight:600; color:#374151; font-size:14px; }
        .upload-hint  { font-size:12px; color:#9CA3AF; margin-top:4px; }

        /* ── Selfie checks ── */
        .selfie-checks { list-style:none; padding:0; margin:0 0 16px; text-align:left; }
        .selfie-checks li { color:#16A34A; font-size:13px; margin-bottom:4px; }
        .selfie-checks li::before { content:"✓ "; }
        .btn-foto {
            display:inline-flex; align-items:center; gap:8px;
            background:#34699A; color:#fff;
            padding:10px 24px; border-radius:6px;
            cursor:pointer; font-weight:600; font-size:14px;
            font-family:inherit; border:none;
        }

        /* ── Submit ── */
        .form-footer { text-align:center; margin-top:40px; }
        .btn-submit {
            background:#34699A; color:#fff;
            font-family:inherit; font-weight:600; font-size:15px;
            padding:14px 64px; border-radius:8px; border:none;
            cursor:pointer; transition:background .2s;
        }
        .btn-submit:hover { background:#2b5a87; }

        /* ── Modal ── */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:999; align-items:center; justify-content:center; }
        .modal-overlay.show { display:flex; }
        .modal-box { background:#fff; border-radius:14px; padding:32px 36px; max-width:520px; width:90%; box-shadow:0 8px 40px rgba(0,0,0,0.18); }
        .modal-section-title { font-size:11px; font-weight:700; color:#6B7280; letter-spacing:.08em; margin:16px 0 8px; text-transform:uppercase; }
        .modal-data-row { display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #F3F4F6; font-size:14px; color:#374151; }
        .modal-data-row:last-child { border-bottom:none; }
        .badge-uploaded { background:#DCFCE7; color:#16A34A; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600; }
        .btn-cek-lagi { background:#fff; border:1.5px solid #34699A; color:#34699A; padding:12px 28px; border-radius:8px; font-weight:600; cursor:pointer; font-size:14px; font-family:inherit; }
        .btn-kirim    { background:#34699A; color:#fff; border:none; padding:12px 28px; border-radius:8px; font-weight:600; cursor:pointer; font-size:14px; font-family:inherit; display:inline-flex; align-items:center; gap:8px; }
        .btn-kirim:hover { background:#2b5a87; }
    </style>
</head>
<body>

    @include('layouts.partials.navbar')

    {{-- ════ MODAL KONFIRMASI ════ --}}
    <div class="modal-overlay" id="modalKonfirmasi">
        <div class="modal-box">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:6px;">
                <div style="background:#E0E7FF; padding:8px; border-radius:8px; font-size:20px;">📄</div>
                <div>
                    <div style="font-weight:700; font-size:16px; color:#1E1E2E;">Konfirmasi data verifikasi</div>
                    <div style="font-size:13px; color:#6B7280;">Pastikan semua data sudah benar sebelum dikirim</div>
                </div>
            </div>

            <div class="modal-section-title">Identitas Diri</div>
            <div style="border:1px solid #E5E7EB; border-radius:8px; padding:0 16px;">
                <div class="modal-data-row"><span>Nama lengkap</span><span id="preview-nama" style="color:#111;font-weight:500;"></span></div>
                <div class="modal-data-row"><span>NIK</span><span id="preview-nik" style="color:#111;font-weight:500;"></span></div>
                <div class="modal-data-row"><span>Foto KTP</span><span class="badge-uploaded" id="preview-ktp">Diunggah</span></div>
                <div class="modal-data-row"><span>Selfie dengan KTP</span><span class="badge-uploaded" id="preview-selfie">Diunggah</span></div>
            </div>

            <div class="modal-section-title">Rekening Pencairan</div>
            <div style="border:1px solid #E5E7EB; border-radius:8px; padding:0 16px;">
                <div class="modal-data-row"><span>Bank</span><span id="preview-bank" style="color:#111;font-weight:500;"></span></div>
                <div class="modal-data-row"><span>Nomor rekening</span><span id="preview-rekening" style="color:#111;font-weight:500;"></span></div>
                <div class="modal-data-row"><span>Nama pemilik</span><span id="preview-pemilik" style="color:#111;font-weight:500;"></span></div>
            </div>

            <div style="display:flex; gap:12px; margin-top:28px; justify-content:center;">
                <button class="btn-cek-lagi" onclick="tutupModal()">✏️ Cek lagi</button>
                <button class="btn-kirim" onclick="document.getElementById('formStep2').submit()">▶ Ya, kirim sekarang</button>
            </div>
        </div>
    </div>

    <main class="page-wrap">

        {{-- Header --}}
        <div class="page-header">
            <a href="{{ route('store.step1Toko') }}" class="btn-back">
                <img src="{{ asset('assets/icons/arrow-left-circle.png') }}" alt="Kembali">
            </a>
            <h1 class="page-title">Verifikasi Toko</h1>
        </div>

        {{-- Stepper --}}
        <div class="stepper-wrap">
            <div class="stepper-dots">
                <div class="stepper-line-done" style="width:calc(100% - 44px);"></div>
                <div class="step-dot done">1</div>
                <div class="step-dot active">2</div>
                <div class="step-dot inactive">3</div>
            </div>
            <div class="stepper-labels">
                <span class="step-label">Info Toko</span>
                <span class="step-label active">Verifikasi</span>
                <span class="step-label">Selesai</span>
            </div>
        </div>

        {{-- Privacy Banner --}}
        <div class="privacy-banner">
            ℹ️ <strong>Pesan Privasi</strong><br>
            Data sensitif anda terenkripsi dan hanya digunakan untuk kebutuhan verifikasi. Rentalin tidak akan membagikan Kartu Identitas anda kepada pengguna lain.
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

            <form id="formStep2" action="{{ route('store.step2Toko.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h2 class="form-section-title">Data Diri</h2>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">NIK (nomor KTP)</label>
                        <input type="text" name="nik" id="input-nik" class="form-input"
                               placeholder="16 digit nomor KTP" maxlength="16"
                               value="{{ old('nik') }}"
                               oninput="syncPreview()">
                        @error('nik') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama lengkap sesuai KTP</label>
                        <input type="text" name="nama_lengkap_ktp" id="input-nama" class="form-input"
                               placeholder="Masukkan nama sesuai KTP"
                               value="{{ old('nama_lengkap_ktp') }}"
                               oninput="syncPreview()">
                        @error('nama_lengkap_ktp') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-grid-2" style="margin-bottom:32px;">
                    {{-- Upload KTP --}}
                    <div class="form-group">
                        <label class="form-label">Kartu Identitas</label>
                        <label class="upload-area">
                            <input type="file" name="foto_ktp" accept="image/*" onchange="handleUpload(this,'preview-ktp','label-ktp')">
                            <div id="label-ktp">
                                <div class="upload-icon">☁</div>
                                <div class="upload-title">Unggah Foto Identitas Diri</div>
                                <div class="upload-hint">Klik untuk menggantikan dokumen</div>
                            </div>
                        </label>
                        @error('foto_ktp') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Selfie --}}
                    <div class="form-group">
                        <label class="form-label">Verifikasi Selfie</label>
                        <div class="upload-area" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
                            <ul class="selfie-checks">
                                <li>Pencahayaan bagus, tidak ada bayangan wajah</li>
                                <li>Wajah harus terlihat jelas, tidak memakai topi/kacamata</li>
                                <li>Wajah harus sesuai dengan kartu identitas</li>
                            </ul>
                            <label class="btn-foto">
                                📷 Foto
                                <input type="file" name="foto_selfie" accept="image/*" style="display:none;" onchange="handleUpload(this,'preview-selfie','label-selfie')">
                            </label>
                            <div id="label-selfie" style="font-size:12px; color:#6B7280; margin-top:8px;"></div>
                        </div>
                        @error('foto_selfie') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <h2 class="form-section-title">Rekening Pencairan</h2>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" name="nama_bank" id="input-bank" class="form-input"
                               placeholder="Masukkan nama Bank"
                               value="{{ old('nama_bank') }}"
                               oninput="syncPreview()">
                        @error('nama_bank') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" id="input-rekening" class="form-input"
                               placeholder="Masukkan nomor rekening"
                               value="{{ old('nomor_rekening') }}"
                               oninput="syncPreview()">
                        @error('nomor_rekening') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Nama Pemilik Rekening</label>
                    <input type="text" name="nama_pemilik_rekening" id="input-pemilik" class="form-input"
                           placeholder="Sesuai dengan nama pada KTP"
                           value="{{ old('nama_pemilik_rekening') }}"
                           oninput="syncPreview()">
                    @error('nama_pemilik_rekening') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-footer">
                    <button type="button" onclick="bukaModal()" class="btn-submit">Lanjutkan</button>
                </div>

            </form>
        </div>

    </main>

    @include('layouts.partials.footer')

    <script>
        function syncPreview() {
            document.getElementById('preview-nama').textContent     = document.getElementById('input-nama').value || '—';
            document.getElementById('preview-nik').textContent      = document.getElementById('input-nik').value || '—';
            document.getElementById('preview-bank').textContent     = document.getElementById('input-bank').value || '—';
            document.getElementById('preview-rekening').textContent = document.getElementById('input-rekening').value || '—';
            document.getElementById('preview-pemilik').textContent  = document.getElementById('input-pemilik').value || '—';
        }
        function handleUpload(input, previewId, labelId) {
            const file = input.files[0];
            if (!file) return;
            const badge = document.getElementById(previewId);
            if (badge) badge.textContent = 'Diunggah ✓';
            const label = document.getElementById(labelId);
            if (label) label.textContent = '✓ ' + file.name;
        }
        function bukaModal() {
            syncPreview();
            document.getElementById('modalKonfirmasi').classList.add('show');
        }
        function tutupModal() {
            document.getElementById('modalKonfirmasi').classList.remove('show');
        }
        document.getElementById('modalKonfirmasi').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
    </script>

</body>
</html>