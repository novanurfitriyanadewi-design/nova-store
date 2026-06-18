<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('description', 'ILIKE', "%{$search}%");
            });
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        DB::table('products')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Produk tidak ditemukan');
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $request->image,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('products')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}