<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')->orderBy('id', 'desc');

        // Tambahkan pencarian
        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('description', 'ILIKE', "%{$search}%");
            });
        }

        // Pagination biar lebih rapi
        $products = $query->paginate(6); // 6 produk per halaman

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'description' => 'nullable',
            'stock'       => 'nullable|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->insert([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'stock'       => $request->stock ?? 0,
            'image'       => $imagePath,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan');
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'description' => 'nullable',
            'stock'       => 'nullable|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan');
        }

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->where('id', $id)->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'stock'       => $request->stock ?? 0,
            'image'       => $imagePath,
            'updated_at'  => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->find($id);

        if ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            DB::table('products')->where('id', $id)->delete();
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
