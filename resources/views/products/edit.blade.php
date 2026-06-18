<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text"
                   name="name"
                   value="{{ $product->name }}"
                   class="border p-2 w-full rounded"
                   required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Price</label>
            <input type="number"
                   name="price"
                   value="{{ $product->price }}"
                   class="border p-2 w-full rounded"
                   required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Stock</label>
            <input type="number"
                   name="stock"
                   value="{{ $product->stock }}"
                   class="border p-2 w-full rounded"
                   required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description"
                      class="border p-2 w-full rounded">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">

            <label class="block font-semibold mb-1">
                Image URL
            </label>

            @if($product->image)
                <img src="{{ $product->image }}"
                     alt="{{ $product->name }}"
                     class="h-32 rounded mb-2">
            @endif

            <input type="url"
                   name="image"
                   value="{{ $product->image }}"
                   class="border p-2 w-full rounded">
        </div>

        <div class="flex gap-2">

            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="{{ route('products.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>

        </div>

    </form>

</div>

</body>
</html>