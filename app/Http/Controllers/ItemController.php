<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan daftar barang milik user yang sedang login
        $query = Item::where('user_id', Auth::id())->with(['category', 'rentals']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->latest()->paginate(12)->withQueryString();

        return view('pages.items.itemsList', compact('items'));
    }

    public function create()
    {
        // Cek toko supaya user tidak bisa akses halaman sewakan barang lewat URL langsung
        // Login tetap dicek dari route middleware auth
        if (Auth::check() && method_exists(Auth::user(), 'toko') && !Auth::user()->toko) {
            return redirect()
                ->route('store')
                ->with('error', 'Anda harus membuka toko terlebih dahulu sebelum menyewakan barang.');
        }

        $categories = Category::all();

        return view('pages.items.itemsEditCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        // Ubah input harga/deposit/denda dari format bertitik menjadi angka biasa
        // Contoh: 10.000 menjadi 10000
        $this->normalizeCurrencyInputs($request);

        // Validasi input sewakan barang
        $request->validate(
            $this->itemValidationRules(false),
            $this->itemValidationMessages()
        );

        // Validasi minimal pilih 1 metode serah terima
        if (!$request->has('is_cod') && !$request->has('is_delivery')) {
            return back()
                ->withErrors(['delivery_method' => 'Minimal pilih 1 metode serah terima.'])
                ->withInput();
        }

        // Upload foto barang ke storage/app/public/items
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file) {
                    $imagePaths[] = $file->store('items', 'public');
                }
            }
        }

        // Bersihkan kelengkapan kosong
        $kelengkapan = $this->cleanArrayInput($request->kelengkapan ?? []);

        // Susun kebijakan pembatalan jika digunakan
        $policies = $this->cleanCancellationPolicies($request->cancellation_policies ?? []);

        // Simpan data barang ke tabel items
        Item::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'stock' => 1,
            'kelengkapan' => $kelengkapan,
            'image' => $imagePaths,
            'status' => 'available',
            'is_cod' => $request->has('is_cod'),
            'is_delivery' => $request->has('is_delivery'),
            'late_fee_percentage' => $request->late_fee_percentage,
            'has_deposit' => $request->has('has_deposit'),
            'deposit_amount' => $request->has('has_deposit') ? $request->deposit_amount : null,
            'cancellation_policies' => $policies,
            'kecamatan' => $request->kecamatan,
        ]);

        return redirect()
            ->route('items.index')
            ->with('success', 'Barang berhasil disewakan.');
    }

    public function show(Item $item)
    {
        // Ambil ulasan terbaru untuk detail barang
        $reviews = $item->reviews()->with('user')->latest()->take(2)->get();

        // Hitung total ulasan dan rata-rata rating
        $totalReviews = $item->reviews()->count();
        $averageRating = $totalReviews > 0 ? $item->reviews()->avg('rating') : 0;

        // Ambil tanggal sewa aktif agar tanggal bentrok tidak bisa dipilih lagi
        $bookedRentals = \App\Models\Rental::where('item_id', $item->id)
            ->whereIn('status', [
                'pesanan_masuk',
                'menunggu_pembayaran',
                'pembayaran_berhasil',
                'diproses',
                'dikirim',
                'menunggu_penerimaan',
                'disewa',
                'belum_dikembalikan',
            ])
            ->get(['start_date', 'end_date']);

        // Format tanggal untuk flatpickr
        $disabledDates = $bookedRentals->map(function ($rental) {
            return [
                'from' => $rental->start_date,
                'to' => $rental->end_date,
            ];
        });

        return view('pages.items.itemsDetail', compact(
            'item',
            'reviews',
            'totalReviews',
            'averageRating',
            'disabledDates'
        ));
    }

    public function edit(Item $item)
    {
        // Hanya pemilik barang yang boleh edit
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke barang ini.');
        }

        $categories = Category::all();

        return view('pages.items.itemsEditCreate', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        // Hanya pemilik barang yang boleh update
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Ubah input harga/deposit/denda dari format bertitik menjadi angka biasa
        $this->normalizeCurrencyInputs($request);

        // Validasi input edit barang
        $request->validate(
            $this->itemValidationRules(true),
            $this->itemValidationMessages()
        );

        // Validasi minimal pilih 1 metode serah terima
        if (!$request->has('is_cod') && !$request->has('is_delivery')) {
            return back()
                ->withErrors(['delivery_method' => 'Minimal pilih 1 metode serah terima.'])
                ->withInput();
        }

        // Bersihkan kelengkapan kosong
        $kelengkapan = $this->cleanArrayInput($request->kelengkapan ?? []);

        // Susun kebijakan pembatalan jika digunakan
        $policies = $this->cleanCancellationPolicies($request->cancellation_policies ?? []);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'kelengkapan' => $kelengkapan,
            'is_cod' => $request->has('is_cod'),
            'is_delivery' => $request->has('is_delivery'),
            'late_fee_percentage' => $request->late_fee_percentage,
            'has_deposit' => $request->has('has_deposit'),
            'deposit_amount' => $request->has('has_deposit') ? $request->deposit_amount : null,
            'cancellation_policies' => $policies,
            'kecamatan' => $request->kecamatan,
        ];

        /*
        |--------------------------------------------------------------------------
        | Update foto barang
        |--------------------------------------------------------------------------
        | Alur:
        | 1. Ambil foto lama dari database.
        | 2. Hapus foto lama yang diklik tombol X.
        | 3. Tambahkan foto baru yang diupload.
        | 4. Batasi maksimal tetap 5 foto.
        */

        $imagePaths = [];

        if (!empty($item->image)) {
            if (is_array($item->image)) {
                $imagePaths = $item->image;
            } else {
                $decodedImages = json_decode($item->image, true);
                $imagePaths = is_array($decodedImages) ? $decodedImages : [$item->image];
            }
        }

        // Hapus foto lama yang dikirim dari tombol X
        $removedImages = $request->input('removed_images', []);

        if (!empty($removedImages)) {
            $imagePaths = array_values(array_filter($imagePaths, function ($path) use ($removedImages) {
                return !in_array($path, $removedImages, true);
            }));
        }

        // Tambahkan foto baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file) {
                    $imagePaths[] = $file->store('items', 'public');
                }
            }
        }

        // Setelah edit, barang tetap harus punya minimal 1 foto
        if (empty($imagePaths)) {
            return back()
                ->withErrors(['images.0' => 'Minimal upload 1 foto barang.'])
                ->withInput();
        }

        // Maksimal 5 foto
        $data['image'] = array_slice($imagePaths, 0, 5);

        $item->update($data);

        return redirect()
            ->route('items.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        // Hanya pemilik barang yang boleh hapus
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    public function toggleStatus(Request $request, Item $item)
    {
        // Hanya pemilik barang yang boleh mengubah status
        if ($item->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak.',
            ], 403);
        }

        // Ubah available menjadi inactive, atau sebaliknya
        $item->status = $item->status === 'available' ? 'inactive' : 'available';
        $item->save();

        return response()->json([
            'success' => true,
            'status' => $item->status,
        ]);
    }

    public function reviews(Item $item)
    {
        // Ambil semua ulasan untuk barang ini
        $reviews = $item->reviews()->with('user')->latest()->get();

        // Hitung statistik ulasan
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;

        // Hitung jumlah rating per bintang
        $ratingCounts = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        return view('pages.reviews.ReviewBarang', compact(
            'item',
            'reviews',
            'totalReviews',
            'averageRating',
            'ratingCounts'
        ));
    }

    public function katalog(Request $request)
    {
        $query = Item::where('status', 'available')
            ->with(['category', 'rentals'])
            ->withCount('rentals');

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter kategori lewat slug
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $items = $query->orderByDesc('rentals_count')->paginate(20)->withQueryString();
        $categories = Category::all();

        // Nama kategori aktif untuk heading
        $kategoriAktif = null;

        if ($request->filled('kategori')) {
            $kategoriAktif = $categories->firstWhere('slug', $request->kategori);
        }

        return view('pages.items.katalog', compact('items', 'categories', 'kategoriAktif'));
    }

    public function home()
    {
        $categories = Category::all();

        // Produk populer berdasarkan jumlah transaksi
        $produkTerpopuler = Item::where('status', 'available')
            ->with(['category'])
            ->withCount('rentals')
            ->orderByDesc('rentals_count')
            ->take(4)
            ->get();

        // Rekomendasi dari barang terbaru
        $rekomendasi = Item::where('status', 'available')
            ->with(['category'])
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('categories', 'produkTerpopuler', 'rekomendasi'));
    }

    public function filterKategori($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil item sesuai kategori
        $items = Item::where('category_id', $category->id)
            ->where('status', 'available')
            ->with(['category'])
            ->withCount('rentals')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('kategori', compact('category', 'items'));
    }

    private function itemValidationRules(bool $isUpdate = false): array
    {
        // Aturan foto beda antara create dan update
        $imageRules = $isUpdate
            ? [
                'images' => 'nullable|array|max:5',
                'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            ]
            : [
                'images' => 'required|array|min:1|max:5',
                'images.0' => 'required|image|mimes:jpeg,jpg,png|max:10240',
                'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            ];

        return array_merge([
            'name' => 'required|string|min:5|max:100',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:20|max:2000',
            'price_per_day' => 'required|numeric|min:0|max:100000000',
            'late_fee_percentage' => 'nullable|numeric|min:0|max:100',
            'has_deposit' => 'nullable|boolean',
            'deposit_amount' => 'required_if:has_deposit,1|nullable|numeric|min:0|lte:price_per_day',
            'kelengkapan' => 'required|array|min:1',
            'kelengkapan.*' => 'required|string|min:1|max:100',
            'is_cod' => 'nullable|boolean',
            'is_delivery' => 'nullable|boolean',
            'kecamatan' => 'required|string|max:255',

            // Untuk tombol X pada foto lama saat edit
            'removed_images' => 'nullable|array',
            'removed_images.*' => 'nullable|string',

            'cancellation_policies' => 'nullable|array',
            'cancellation_policies.*.days_before' => 'nullable|integer|min:0|max:365',
            'cancellation_policies.*.refund_percentage' => 'nullable|integer|min:0|max:100',
        ], $imageRules);
    }

    private function itemValidationMessages(): array
    {
        return [
            'name.required' => 'Nama barang wajib diisi.',
            'name.min' => 'Nama barang minimal 5 karakter.',
            'name.max' => 'Nama barang maksimal 100 karakter.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'description.required' => 'Deskripsi barang wajib diisi.',
            'description.min' => 'Deskripsi barang minimal 20 karakter.',
            'description.max' => 'Deskripsi barang maksimal 2000 karakter.',

            'price_per_day.required' => 'Harga sewa per hari wajib diisi.',
            'price_per_day.numeric' => 'Harga sewa harus berupa angka.',
            'price_per_day.min' => 'Harga sewa tidak boleh kurang dari 0.',
            'price_per_day.max' => 'Harga sewa terlalu besar.',

            'late_fee_percentage.numeric' => 'Denda keterlambatan harus berupa angka.',
            'late_fee_percentage.min' => 'Denda keterlambatan tidak boleh kurang dari 0%.',
            'late_fee_percentage.max' => 'Denda keterlambatan maksimal 100%.',

            'deposit_amount.required_if' => 'Nominal deposit wajib diisi jika deposit diaktifkan.',
            'deposit_amount.numeric' => 'Nominal deposit harus berupa angka.',
            'deposit_amount.min' => 'Nominal deposit tidak boleh kurang dari 0.',
            'deposit_amount.lte' => 'Nominal deposit tidak boleh melebihi harga sewa per hari.',

            'images.required' => 'Minimal upload 1 foto barang.',
            'images.array' => 'Foto barang tidak valid.',
            'images.min' => 'Minimal upload 1 foto barang.',
            'images.max' => 'Maksimal upload 5 foto barang.',
            'images.0.required' => 'Foto utama wajib diunggah.',
            'images.0.image' => 'Foto utama harus berupa gambar.',
            'images.0.mimes' => 'Format foto utama harus JPEG atau PNG.',
            'images.0.max' => 'Ukuran foto utama maksimal 10MB.',
            'images.*.image' => 'File yang diunggah harus berupa gambar.',
            'images.*.mimes' => 'Format foto harus JPEG atau PNG.',
            'images.*.max' => 'Ukuran setiap foto maksimal 10MB.',

            'kelengkapan.required' => 'Minimal isi 1 kelengkapan barang.',
            'kelengkapan.array' => 'Kelengkapan barang tidak valid.',
            'kelengkapan.min' => 'Minimal isi 1 kelengkapan barang.',
            'kelengkapan.*.required' => 'Kelengkapan barang tidak boleh kosong.',
            'kelengkapan.*.max' => 'Kelengkapan barang maksimal 100 karakter.',

            'kecamatan.required' => 'Kecamatan wajib dipilih.',

            'cancellation_policies.*.days_before.integer' => 'Hari sebelum sewa harus berupa angka.',
            'cancellation_policies.*.days_before.min' => 'Hari sebelum sewa tidak boleh kurang dari 0.',
            'cancellation_policies.*.days_before.max' => 'Hari sebelum sewa maksimal 365 hari.',
            'cancellation_policies.*.refund_percentage.integer' => 'Persentase refund harus berupa angka.',
            'cancellation_policies.*.refund_percentage.min' => 'Persentase refund tidak boleh kurang dari 0%.',
            'cancellation_policies.*.refund_percentage.max' => 'Persentase refund maksimal 100%.',
        ];
    }

    private function normalizeCurrencyInputs(Request $request): void
    {
        // Hapus titik ribuan sebelum validasi numeric
        // Denda juga dibatasi maksimal 100 dari controller agar tetap aman walaupun JS dimatikan
        $lateFee = $this->toPlainNumber($request->late_fee_percentage);

        if ($lateFee !== null && $lateFee !== '') {
            $lateFee = min((int) $lateFee, 100);
        }

        $request->merge([
            'price_per_day' => $this->toPlainNumber($request->price_per_day),
            'deposit_amount' => $this->toPlainNumber($request->deposit_amount),
            'late_fee_percentage' => $lateFee,
        ]);
    }

    private function toPlainNumber($value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        return preg_replace('/[^0-9]/', '', (string) $value);
    }

    private function cleanArrayInput(array $items): array
    {
        // Buang isi kelengkapan yang kosong
        return array_values(array_filter(array_map(function ($item) {
            return trim((string) $item);
        }, $items), function ($item) {
            return $item !== '';
        }));
    }

    private function cleanCancellationPolicies(array $policies): array
    {
        $cleanPolicies = [];

        foreach ($policies as $policy) {
            if (!empty($policy['days_before']) && !empty($policy['refund_percentage'])) {
                $cleanPolicies[] = $policy;
            }
        }

        return $cleanPolicies;
    }
}