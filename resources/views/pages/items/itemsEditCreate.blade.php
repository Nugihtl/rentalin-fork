<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($item) ? 'Edit Barang' : 'Sewakan Barang' }} - Rentalin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F9FAFB;
        }

        #deposit-input-area {
            transition: all 0.3s ease-in-out;
            overflow: hidden;
        }

        .deposit-hidden {
            opacity: 0;
            max-height: 0;
            margin-bottom: 0 !important;
            padding-top: 0;
            padding-bottom: 0;
            border: none;
        }

        .deposit-visible {
            opacity: 1;
            max-height: 150px;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body class="text-gray-800">
@include('layouts.partials.navbar')

@php
    $isEdit = isset($item);
    $formAction = $isEdit ? route('items.update', $item->id) : route('items.store');

    $oldImages = [];

    if ($isEdit && !empty($item->image)) {
        if (is_array($item->image)) {
            $oldImages = $item->image;
        } else {
            $decodedImages = json_decode($item->image, true);
            $oldImages = is_array($decodedImages) ? $decodedImages : [$item->image];
        }
    }

    $oldKelengkapan = old('kelengkapan');

    if (!$oldKelengkapan && $isEdit) {
        if (is_array($item->kelengkapan)) {
            $oldKelengkapan = $item->kelengkapan;
        } else {
            $decodedKelengkapan = json_decode($item->kelengkapan ?? '[]', true);
            $oldKelengkapan = is_array($decodedKelengkapan) ? $decodedKelengkapan : [];
        }
    }

    if (!$oldKelengkapan || count($oldKelengkapan) === 0) {
        $oldKelengkapan = [''];
    }

    $itemImageEditCreateUrl = function ($path) {
        if (!$path) {
            return '';
        }

        if (
            str_starts_with($path, 'items/') ||
            str_starts_with($path, 'uploads/') ||
            str_starts_with($path, 'products/')
        ) {
            return asset('storage/' . $path);
        }

        return asset('assets/products/' . $path);
    };
@endphp

<main class="max-w-5xl mx-auto px-4 py-8">
    {{-- Header halaman --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('items.index') }}"
           class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
           aria-label="Kembali">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <h1 class="text-2xl font-bold text-gray-900">
            {{ $isEdit ? 'Edit barang' : 'Sewakan barang' }}
        </h1>
    </div>

    {{-- Pesan error global dari controller --}}
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            <p class="font-semibold mb-2">Ada data yang belum sesuai:</p>

            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        {{-- Form barang --}}
        <form id="form-item"
              action="{{ $formAction }}"
              method="POST"
              enctype="multipart/form-data"
              data-is-edit="{{ $isEdit ? '1' : '0' }}"
              data-existing-image-count="{{ count($oldImages) }}"
              novalidate>
            @csrf

            @if($isEdit)
                @method('PUT')
            @endif

            {{-- Foto barang --}}
            <div class="mb-8">
                <h2 class="text-base font-semibold text-gray-900 mb-1">
                    Foto Barang
                    @if(!$isEdit)
                        <span class="text-red-500">*</span>
                    @endif
                </h2>

                <p class="text-sm text-gray-500 mb-4">
                    Tambahkan hingga 5 foto. Foto pertama akan menjadi sampul utama.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        @php
                            $oldImagePath = $oldImages[$i] ?? '';
                            $oldImageUrl = $oldImagePath ? $itemImageEditCreateUrl($oldImagePath) : '';
                        @endphp

                        {{-- PERBAIKAN 1: Tambahkan atribut for="..." pada label --}}
                        <label for="{{ $i === 0 ? 'foto-utama' : 'foto-' . $i }}" class="relative aspect-square rounded-xl border-2 border-dashed border-blue-200 bg-blue-50/50 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 transition overflow-hidden">
                            
                            {{-- Preview foto (Tambahkan pointer-events-none) --}}
                            <img class="preview-img absolute inset-0 w-full h-full object-cover pointer-events-none {{ $oldImageUrl ? '' : 'hidden' }}"
                                 src="{{ $oldImageUrl }}"
                                 alt="Preview Foto">

                            {{-- Tombol X untuk hapus foto (z-20 agar berada di atas input) --}}
                            <button type="button"
                                    class="btn-remove-photo absolute top-2 right-2 z-20 w-7 h-7 rounded-full bg-red-500 text-white text-sm font-bold flex items-center justify-center shadow hover:bg-red-600 {{ $oldImageUrl ? '' : 'hidden' }}"
                                    data-old-image="{{ $oldImagePath }}"
                                    onclick="removePhoto(this, event)"
                                    aria-label="Hapus foto">
                                ×
                            </button>

                            {{-- Konten upload sebelum ada foto (Tambahkan pointer-events-none) --}}
                            <div class="upload-content flex flex-col items-center text-center p-2 pointer-events-none {{ $oldImageUrl ? 'hidden' : '' }}">
                                @if($i === 0)
                                    <span class="font-medium text-blue-500 mb-1 text-sm">Foto Utama</span>
                                @else
                                    <svg class="w-8 h-8 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif

                                <span class="text-[10px] text-gray-400">JPEG/PNG (Max 10MB)</span>
                            </div>

                            {{-- PERBAIKAN 2: Hilangkan class "hidden", jadikan transparan dengan "opacity-0 absolute inset-0 z-10" --}}
                            <input type="file"
                                   id="{{ $i === 0 ? 'foto-utama' : 'foto-' . $i }}"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 input-foto"
                                   name="images[{{ $i }}]"
                                   accept="image/jpeg,image/jpg,image/png"
                                   onchange="previewImage(this)">
                        </label>
                    @endfor
                </div>

                {{-- Foto lama yang dihapus saat edit akan disimpan di sini --}}
                <div id="removed-images-container"></div>

                <p id="error-foto" class="text-sm text-red-500 mt-2 hidden">
                    Foto utama wajib diunggah.
                </p>

                @error('images')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror

                @error('images.0')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-100 mb-8">

            {{-- Kategori --}}
            <div class="mb-8">
                <h2 class="text-base font-semibold text-gray-900 mb-4">
                    Kategori <span class="text-red-500">*</span>
                </h2>

                <div class="flex flex-wrap gap-3">
                    @foreach($categories as $category)
                        @php
                            $selectedCategory = old('category_id', $isEdit ? $item->category_id : null);
                            $isChecked = (string) $selectedCategory === (string) $category->id || (!$selectedCategory && $loop->first);
                        @endphp

                        <label class="cursor-pointer">
                            <input type="radio"
                                   name="category_id"
                                   value="{{ $category->id }}"
                                   class="peer hidden"
                                   {{ $isChecked ? 'checked' : '' }}>

                            <div class="px-4 py-2.5 rounded-full border border-gray-200 bg-white text-sm font-medium text-gray-700 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition flex items-center gap-2">
                                {{ $category->name }}
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('category_id')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama barang --}}
            <div class="mb-6">
                <label class="block text-base font-semibold text-gray-900 mb-2">
                    Nama Barang <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $isEdit ? $item->name : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                       placeholder="Masukkan nama barang yang akan disewakan"
                       minlength="5"
                       maxlength="100">

                <p id="error-name" class="text-sm text-red-500 mt-2 hidden">
                    Nama barang wajib diisi, minimal 5 karakter dan maksimal 100 karakter.
                </p>

                @error('name')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi barang --}}
            <div class="mb-8">
                <label class="block text-base font-semibold text-gray-900 mb-2">
                    Deskripsi Barang <span class="text-red-500">*</span>
                </label>

                <textarea id="description"
                          name="description"
                          rows="4"
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm resize-none"
                          placeholder="Tuliskan spesifikasi, kondisi, dan keunggulan barang"
                          minlength="20"
                          maxlength="2000">{{ old('description', $isEdit ? $item->description : '') }}</textarea>

                <p id="error-description" class="text-sm text-red-500 mt-2 hidden">
                    Deskripsi barang wajib diisi, minimal 20 karakter dan maksimal 2000 karakter.
                </p>

                @error('description')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-100 mb-8">

            {{-- Kelengkapan barang --}}
            <div class="mb-8">
                <h2 class="text-base font-semibold text-gray-900 mb-1">
                    Kelengkapan Barang <span class="text-red-500">*</span>
                </h2>

                <p class="text-sm text-gray-500 mb-4">
                    Tambahkan item yang termasuk dalam paket sewa. Wajib mengisi minimal 1 kelengkapan.
                </p>

                <div id="kelengkapan-container" class="space-y-3 mb-4">
                    @foreach($oldKelengkapan as $kelengkapan)
                        <div class="kelengkapan-row">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400 cursor-move" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M4 8h16M4 16h16">
                                    </path>
                                </svg>

                                <input type="text"
                                       name="kelengkapan[]"
                                       value="{{ $kelengkapan }}"
                                       maxlength="100"
                                       class="input-kelengkapan flex-1 px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                       placeholder="Masukkan detail kelengkapan">

                                <button type="button"
                                        class="btn-hapus-kelengkapan text-red-500 hover:bg-red-50 p-2 rounded-lg transition"
                                        aria-label="Hapus kelengkapan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            @error('kelengkapan.' . $loop->index)
                                <p class="text-sm text-red-500 mt-2 ml-8">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <p id="error-kelengkapan" class="text-sm text-red-500 mb-3 hidden">
                    Minimal isi 1 kelengkapan barang. Setiap kelengkapan tidak boleh kosong dan maksimal 100 karakter.
                </p>

                @error('kelengkapan')
                    <p class="text-sm text-red-500 mb-3">{{ $message }}</p>
                @enderror

                <button type="button"
                        id="btn-tambah-kelengkapan"
                        class="text-blue-600 text-sm font-medium flex items-center gap-1 hover:text-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Tambah Kelengkapan
                </button>
            </div>

            <hr class="border-gray-100 mb-8">

            {{-- Harga dan denda --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-base font-semibold text-gray-900 mb-2">
                        Harga Sewa per Hari <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>

                        <input type="text"
                               id="price_per_day"
                               name="price_per_day"
                               value="{{ old('price_per_day', $isEdit ? number_format($item->price_per_day ?? 0, 0, ',', '.') : '') }}"
                               class="currency-input w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none text-sm"
                               placeholder="Tentukan harga sewa"
                               inputmode="numeric">
                    </div>

                    @error('price_per_day')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-base font-semibold text-gray-900 mb-2">
                        Persentase Denda Terlambat
                    </label>

                    <div class="relative">
                        <input type="number"
                               id="late_fee_percentage"
                               name="late_fee_percentage"
                               value="{{ old('late_fee_percentage', $isEdit ? $item->late_fee_percentage : '') }}"
                               class="w-full pl-4 pr-16 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none text-sm"
                               placeholder="Tentukan denda keterlambatan"
                               min="0"
                               max="100">

                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">% / hari</span>
                    </div>

                    <p id="error-late-fee" class="text-sm text-red-500 mt-2 hidden">
                        Denda keterlambatan maksimal 100%.
                    </p>

                    @error('late_fee_percentage')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Toggle deposit --}}
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Terapkan Deposit</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Jaminan uang kembali jika barang rusak/hilang.</p>
                </div>

                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                           id="toggle-deposit"
                           name="has_deposit"
                           value="1"
                           class="sr-only peer"
                           {{ old('has_deposit', $isEdit ? $item->has_deposit : true) ? 'checked' : '' }}>

                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            {{-- Input deposit --}}
            <div id="deposit-input-area" class="{{ old('has_deposit', $isEdit ? $item->has_deposit : true) ? 'deposit-visible' : 'deposit-hidden' }}">
                <label class="block text-base font-semibold text-gray-900 mb-2">
                    Nominal Deposit <span class="text-red-500">*</span>
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>

                    <input type="text"
                           id="deposit_amount"
                           name="deposit_amount"
                           value="{{ old('deposit_amount', $isEdit && $item->deposit_amount ? number_format($item->deposit_amount, 0, ',', '.') : '') }}"
                           class="currency-input w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none text-sm"
                           placeholder="Tentukan nominal deposit"
                           inputmode="numeric"
                           {{ old('has_deposit', $isEdit ? $item->has_deposit : true) ? 'required' : '' }}>
                </div>

                <p id="error-deposit" class="text-sm text-red-500 mt-2 hidden">
                    Nominal deposit tidak boleh melebihi harga sewa per hari.
                </p>

                @error('deposit_amount')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-100 mb-8">

            {{-- Metode serah terima --}}
            <div class="mb-10">
                <h2 class="text-base font-semibold text-gray-900 mb-1">
                    Metode Serah Terima <span class="text-red-500">*</span>
                </h2>

                <p class="text-sm text-gray-500 mb-4">
                    Pilih lokasi ketersediaan barang untuk pengambilan atau pengiriman. Pemilik dapat memilih lebih dari satu metode.
                </p>

                <div class="flex flex-wrap items-center gap-6 mb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                               id="is_cod"
                               name="is_cod"
                               value="1"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                               {{ old('is_cod', $isEdit ? $item->is_cod : true) ? 'checked' : '' }}>

                        <span class="text-sm text-gray-700">COD (Ambil di tempat)</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                               id="is_delivery"
                               name="is_delivery"
                               value="1"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                               {{ old('is_delivery', $isEdit ? $item->is_delivery : false) ? 'checked' : '' }}>

                        <span class="text-sm text-gray-700">Dikirim melalui kurir</span>
                    </label>
                </div>

                <p id="error-metode" class="text-sm text-red-500 mb-4 hidden">
                    Minimal pilih 1 metode serah terima.
                </p>

                @error('delivery_method')
                    <p class="text-sm text-red-500 mb-4">{{ $message }}</p>
                @enderror

                <div class="relative">
                    <select id="kecamatan-select"
                            name="kecamatan"
                            data-selected="{{ old('kecamatan', $isEdit ? $item->kecamatan : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white">
                        <option value="">Memuat data wilayah...</option>
                    </select>
                </div>

                <p id="error-kecamatan" class="text-sm text-red-500 mt-2 hidden">
                    Kecamatan wajib dipilih.
                </p>

                @error('kecamatan')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol submit --}}
            <div class="flex justify-center">
                <button type="submit"
                        class="bg-[#34699A] hover:bg-[#28537a] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-white font-semibold py-3 px-12 rounded-xl transition shadow-sm w-full md:w-auto min-w-[200px]">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Sewakan' }}
                </button>
            </div>
        </form>
    </div>
</main>

@include('layouts.partials.footer')

<script>
    // Format angka dengan titik ribuan
    function formatNumberWithDots(value) {
        return value
            .replace(/\D/g, '')
            .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Ubah angka bertitik menjadi angka biasa
    function cleanNumber(value) {
        return String(value || '').replace(/\./g, '').replace(/\D/g, '');
    }

    // Hitung jumlah foto yang sedang tampil di preview
    function countActivePhotos() {
        let total = 0;

        document.querySelectorAll('.preview-img').forEach(function(img) {
            if (!img.classList.contains('hidden')) {
                total++;
            }
        });

        return total;
    }

    // Tampilkan preview gambar saat user memilih foto
    function previewImage(input) {
        const errorFoto = document.getElementById('error-foto');
        const file = input.files && input.files[0] ? input.files[0] : null;

        if (!file) {
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 10 * 1024 * 1024;

        if (!allowedTypes.includes(file.type)) {
            input.value = '';
            errorFoto.textContent = 'Format foto harus JPEG atau PNG.';
            errorFoto.classList.remove('hidden');
            return;
        }

        if (file.size > maxSize) {
            input.value = '';
            errorFoto.textContent = 'Ukuran setiap foto maksimal 10MB.';
            errorFoto.classList.remove('hidden');
            return;
        }

        const label = input.closest('label');
        const removeButton = label.querySelector('.btn-remove-photo');

        // Jika slot ini sebelumnya berisi foto lama, catat sebagai foto yang dihapus
        if (removeButton && removeButton.dataset.oldImage) {
            addRemovedImage(removeButton.dataset.oldImage);
            removeButton.dataset.oldImage = '';
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            const img = label.querySelector('.preview-img');
            const content = label.querySelector('.upload-content');

            img.src = e.target.result;
            img.classList.remove('hidden');

            if (content) {
                content.classList.add('hidden');
            }

            if (removeButton) {
                removeButton.classList.remove('hidden');
            }
        };

        reader.readAsDataURL(file);

        if (input.id === 'foto-utama') {
            errorFoto.classList.add('hidden');
        }
    }

    // Simpan path foto lama yang dihapus ke hidden input
    function addRemovedImage(path) {
        if (!path) {
            return;
        }

        const container = document.getElementById('removed-images-container');

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'removed_images[]';
        input.value = path;

        container.appendChild(input);
    }

    // Hapus foto dari preview
    function removePhoto(button, event) {
        event.preventDefault();
        event.stopPropagation();

        const label = button.closest('label');
        const input = label.querySelector('input[type="file"]');
        const img = label.querySelector('.preview-img');
        const content = label.querySelector('.upload-content');

        // Jika foto lama dari database, catat agar controller menghapusnya dari array image
        if (button.dataset.oldImage) {
            addRemovedImage(button.dataset.oldImage);
            button.dataset.oldImage = '';
        }

        input.value = '';

        img.removeAttribute('src');
        img.classList.add('hidden');

        if (content) {
            content.classList.remove('hidden');
        }

        button.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', async function() {
        const formItem = document.getElementById('form-item');
        const isEdit = formItem.dataset.isEdit === '1';
        const existingImageCount = Number(formItem.dataset.existingImageCount || 0);

        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const errorName = document.getElementById('error-name');
        const errorDescription = document.getElementById('error-description');

        const fotoUtama = document.getElementById('foto-utama');
        const errorFoto = document.getElementById('error-foto');

        const toggleDeposit = document.getElementById('toggle-deposit');
        const depositArea = document.getElementById('deposit-input-area');
        const depositInput = document.getElementById('deposit_amount');
        const errorDeposit = document.getElementById('error-deposit');

        const priceInput = document.getElementById('price_per_day');
        const lateFeeInput = document.getElementById('late_fee_percentage');
        const errorLateFee = document.getElementById('error-late-fee');

        const isCodInput = document.getElementById('is_cod');
        const isDeliveryInput = document.getElementById('is_delivery');
        const errorMetode = document.getElementById('error-metode');

        const kelengkapanContainer = document.getElementById('kelengkapan-container');
        const btnTambahKelengkapan = document.getElementById('btn-tambah-kelengkapan');
        const errorKelengkapan = document.getElementById('error-kelengkapan');

        const selectKecamatan = document.getElementById('kecamatan-select');
        const errorKecamatan = document.getElementById('error-kecamatan');

        // Pasang format titik otomatis ke harga dan deposit
        document.querySelectorAll('.currency-input').forEach(function(input) {
            input.addEventListener('input', function() {
                input.value = formatNumberWithDots(input.value);
            });
        });

        // Batasi denda maksimal 100%
        if (lateFeeInput) {
            lateFeeInput.addEventListener('input', function() {
                if (Number(lateFeeInput.value) > 100) {
                    lateFeeInput.value = 100;
                    errorLateFee.classList.remove('hidden');
                } else {
                    errorLateFee.classList.add('hidden');
                }

                if (Number(lateFeeInput.value) < 0) {
                    lateFeeInput.value = 0;
                }
            });
        }

        // Tampilkan atau sembunyikan input deposit
        toggleDeposit.addEventListener('change', function() {
            if (this.checked) {
                depositArea.className = 'deposit-visible';
                depositInput.required = true;
            } else {
                depositArea.className = 'deposit-hidden';
                depositInput.required = false;
                depositInput.value = '';
                errorDeposit.classList.add('hidden');
            }
        });

        // Tambah baris kelengkapan
        btnTambahKelengkapan.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'kelengkapan-row mt-3';

            row.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400 cursor-move" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                    </svg>

                    <input type="text"
                           name="kelengkapan[]"
                           maxlength="100"
                           class="input-kelengkapan flex-1 px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                           placeholder="Masukkan detail kelengkapan">

                    <button type="button"
                            class="btn-hapus-kelengkapan text-red-500 hover:bg-red-50 p-2 rounded-lg transition"
                            aria-label="Hapus kelengkapan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            `;

            kelengkapanContainer.appendChild(row);
            errorKelengkapan.classList.add('hidden');
        });

        // Hapus baris kelengkapan
        kelengkapanContainer.addEventListener('click', function(e) {
            const btnHapus = e.target.closest('.btn-hapus-kelengkapan');

            if (!btnHapus) {
                return;
            }

            const rows = kelengkapanContainer.querySelectorAll('.kelengkapan-row');

            if (rows.length <= 1) {
                errorKelengkapan.classList.remove('hidden');
                return;
            }

            btnHapus.closest('.kelengkapan-row').remove();
        });

        // Validasi sebelum form dikirim
        formItem.addEventListener('submit', function(e) {
            let isValid = true;

            const priceValue = Number(cleanNumber(priceInput.value || '0'));
            const depositValue = Number(cleanNumber(depositInput.value || '0'));

            // Cek nama barang
            const nameValue = nameInput.value.trim();

            if (nameValue.length < 5 || nameValue.length > 100) {
                errorName.classList.remove('hidden');
                isValid = false;
            } else {
                errorName.classList.add('hidden');
            }

            // Cek deskripsi barang
            const descriptionValue = descriptionInput.value.trim();

            if (descriptionValue.length < 20 || descriptionValue.length > 2000) {
                errorDescription.classList.remove('hidden');
                isValid = false;
            } else {
                errorDescription.classList.add('hidden');
            }

            // Cek foto
            const activePhotoCount = countActivePhotos();

            if (!isEdit && fotoUtama.files.length === 0 && existingImageCount === 0) {
                errorFoto.textContent = 'Foto utama wajib diunggah.';
                errorFoto.classList.remove('hidden');
                isValid = false;
            } else if (isEdit && activePhotoCount === 0) {
                errorFoto.textContent = 'Minimal upload 1 foto barang.';
                errorFoto.classList.remove('hidden');
                isValid = false;
            } else {
                errorFoto.classList.add('hidden');
            }

            // Cek metode serah terima
            if (!isCodInput.checked && !isDeliveryInput.checked) {
                errorMetode.classList.remove('hidden');
                isValid = false;
            } else {
                errorMetode.classList.add('hidden');
            }

            // Cek deposit tidak boleh melebihi harga sewa
            if (toggleDeposit.checked && depositValue > priceValue) {
                errorDeposit.classList.remove('hidden');
                isValid = false;
            } else {
                errorDeposit.classList.add('hidden');
            }

            // Cek denda tidak boleh lebih dari 100
            if (lateFeeInput.value && Number(lateFeeInput.value) > 100) {
                errorLateFee.classList.remove('hidden');
                isValid = false;
            }

            // Cek minimal 1 kelengkapan terisi dan maksimal 100 karakter
            const kelengkapanInputs = kelengkapanContainer.querySelectorAll('input[name="kelengkapan[]"]');

            let hasKelengkapan = false;
            let kelengkapanValid = true;

            kelengkapanInputs.forEach(function(input) {
                const value = input.value.trim();

                if (value !== '') {
                    hasKelengkapan = true;
                }

                if (value === '' || value.length > 100) {
                    kelengkapanValid = false;
                }
            });

            if (!hasKelengkapan || !kelengkapanValid) {
                errorKelengkapan.classList.remove('hidden');
                isValid = false;
            } else {
                errorKelengkapan.classList.add('hidden');
            }

            // Cek kecamatan
            if (!selectKecamatan.value) {
                errorKecamatan.classList.remove('hidden');
                isValid = false;
            } else {
                errorKecamatan.classList.add('hidden');
            }

            if (!isValid) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            // Kirim harga dan deposit sebagai angka biasa tanpa titik
            priceInput.value = cleanNumber(priceInput.value);

            if (depositInput) {
                depositInput.value = cleanNumber(depositInput.value);
            }
        });

        // Ambil daftar kecamatan dari API wilayah
        const selectedKecamatan = selectKecamatan.dataset.selected || '';

        const bandungRayaIds = ['3204', '3217', '3273', '3277'];
        const sumedangId = '3211';
        const wilayahSumedangDiizinkan = ['JATINANGOR'];

        try {
            let semuaKecamatan = [];

            const fetchPromises = bandungRayaIds.map(function(id) {
                return fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${id}.json`)
                    .then(function(res) {
                        return res.json();
                    });
            });

            const hasilBandungRaya = await Promise.all(fetchPromises);

            hasilBandungRaya.forEach(function(data) {
                semuaKecamatan = semuaKecamatan.concat(data);
            });

            const resSumedang = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${sumedangId}.json`);
            const dataSumedang = await resSumedang.json();

            const filterSumedang = dataSumedang.filter(function(kecamatan) {
                return wilayahSumedangDiizinkan.includes(kecamatan.name.toUpperCase());
            });

            semuaKecamatan = semuaKecamatan.concat(filterSumedang);

            semuaKecamatan.sort(function(a, b) {
                return a.name.localeCompare(b.name);
            });

            selectKecamatan.innerHTML = '<option value="">Pilih kecamatan</option>';

            semuaKecamatan.forEach(function(kecamatan) {
                const namaFormat = kecamatan.name.toLowerCase().replace(/\b\w/g, function(s) {
                    return s.toUpperCase();
                });

                const option = document.createElement('option');
                option.value = namaFormat;
                option.textContent = namaFormat;

                if (selectedKecamatan === namaFormat) {
                    option.selected = true;
                }

                selectKecamatan.appendChild(option);
            });
        } catch (error) {
            console.error('Gagal mengambil data API wilayah:', error);
            selectKecamatan.innerHTML = '<option value="">Gagal memuat wilayah. Silakan refresh halaman.</option>';
        }
    });
</script>
</body>
</html>