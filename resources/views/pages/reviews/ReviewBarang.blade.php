<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Barang - Rentalin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F9FAFB; }
    </style>
</head>
<body class="text-gray-800">

    @include('layouts.partials.navbar')

    <main class="max-w-4xl mx-auto px-4 py-8">
        
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('items.show', $item->id) }}" class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-300 hover:bg-gray-100 transition">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Review</h1>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $item->name }}</h2>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <span class="font-bold text-gray-900">{{ number_format($averageRating, 1) }}</span>
                <span class="text-sm text-gray-500">/ 5.0</span>
                <span class="text-sm text-gray-500 ml-1">({{ $totalReviews }} ulasan)</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-6 flex flex-col md:flex-row gap-8 items-center shadow-sm">
            
            <div class="w-full md:w-1/2 space-y-2.5">
                @for ($i = 5; $i >= 1; $i--)
                    @php
                        $count = $ratingCounts[$i] ?? 0;
                        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-8 text-gray-600 font-medium">{{ $i }} ★</span>
                        <div class="flex-1 h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%;"></div>
                        </div>
                        <span class="w-4 text-gray-600 text-right">{{ $count }}</span>
                    </div>
                @endfor
            </div>

            <div class="w-full md:w-1/2 flex flex-wrap gap-2 justify-start md:justify-center">
                <button class="px-5 py-2 rounded-full text-sm font-medium bg-[#34699A] text-white transition">Semua</button>
                <button class="px-5 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 transition">5 Bintang</button>
                <button class="px-5 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 transition">4 Bintang</button>
                <button class="px-5 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 transition">Dengan Foto</button>
            </div>
        </div>

       <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'User') }}&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full object-cover" alt="Avatar">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $review->user->name ?? 'Pengguna' }}</p>
                                <p class="text-xs text-gray-500">{{ $review->created_at->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 text-xs">
                            @for($i = 0; $i < $review->rating; $i++)
                                ⭐
                            @endfor
                        </div>
                    </div>
                    
                    @if($review->comment)
                        <p class="text-sm text-gray-700 mb-4">{{ $review->comment }}</p>
                    @endif

                    @if($review->image)
                        <div class="flex gap-2">
                            <img src="{{ asset('storage/' . $review->image) }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200 cursor-pointer" alt="Foto ulasan">
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white p-6 rounded-2xl border border-gray-200 text-center py-10">
                    <p class="text-gray-500 text-sm">Belum ada ulasan untuk barang ini.</p>
                </div>
            @endforelse
        </div>

    </main>

    @include('layouts.partials.footer')

</body>
</html>