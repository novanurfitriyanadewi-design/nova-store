<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Produk</h1>

    {{-- Search Bar --}}
    <form action="{{ route('products.index') }}" method="GET" class="flex justify-center mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari produk..."
               class="border rounded-l px-4 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r">
            Search
        </button>
    </form>

    <a href="{{ route('products.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-6 inline-block">
        + Tambah Produk
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                {{-- GAMBAR --}}
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="h-40 w-full object-cover rounded mb-3">
                @else
                    <div class="h-40 bg-gray-200 flex items-center justify-center rounded mb-3 text-gray-500">
                        No Image
                    </div>
                @endif

                {{-- DETAIL PRODUK --}}
                <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                <p class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 mb-3">{{ $product->description }}</p>

                {{-- AKSI --}}
                <div class="flex gap-2">
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada produk.</p>
        @endforelse
    </div>
</div>

</body>
</html>
