<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold text-center mb-6">
        Daftar Produk
    </h1>

    {{-- Search --}}
    <form action="{{ route('products.index') }}"
          method="GET"
          class="flex justify-center mb-6">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="border rounded-l px-4 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r">
            Search
        </button>

    </form>

    {{-- Tombol tambah --}}
    <div class="mb-6">
        <a href="{{ route('products.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Tambah Produk
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Produk --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($products as $product)

            <div class="bg-white rounded-lg shadow-md overflow-hidden">

                {{-- Gambar --}}
                @if($product->image)
                    <img
                        src="{{ $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-56 object-cover">
                @else
                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                        No Image
                    </div>
                @endif

                <div class="p-4">

                    <h2 class="text-xl font-bold mb-2">
                        {{ $product->name }}
                    </h2>

                    <p class="text-blue-600 font-semibold mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <p class="text-gray-600 text-sm mb-4">
                        {{ $product->description }}
                    </p>

                    <div class="flex gap-2">

                        <a href="{{ route('products.edit', $product->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-3 text-center text-gray-500">
                Belum ada produk.
            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>

</body>
</html>