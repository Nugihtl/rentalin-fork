<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F5F7FA] text-[#1E1E1E]">

<main class="max-w-[900px] mx-auto px-[24px] py-[40px]">

    <a href="{{ url()->previous() }}" class="text-[#34699A] font-semibold">
        ← Kembali
    </a>

    <div class="bg-white border border-[#D7E5FA] rounded-[10px] p-[24px] mt-[20px]">
        <h1 class="text-[24px] font-bold mb-[14px]">
            {{ $transaksi->nama_produk }}
        </h1>

        <p class="text-[14px] text-[#6B7280]">
            ID Transaksi: {{ $transaksi->kode_transaksi }}
        </p>

        <p class="text-[14px] text-[#6B7280] mt-[6px]">
            Status saat ini: {{ $transaksi->status }}
        </p>
    </div>

</main>

</body>
</html>