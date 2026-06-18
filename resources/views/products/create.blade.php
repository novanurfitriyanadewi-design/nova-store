<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Stock</label>
            <input type="number" name="stock" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="border p-2 w-full rounded"></textarea>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Image URL</label>
            <input type="url"
                   name="image"
                   placeholder="https://..."
                   class="border p-2 w-full rounded">
        </div>

        <div class="flex gap-2">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
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