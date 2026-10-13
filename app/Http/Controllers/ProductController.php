<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // Eager loading: category & user diambil sekaligus (menghindari N+1)
        $products = Product::with(['category', 'user'])->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        Gate::authorize('create', Product::class);

        return view('products.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Product::class);

        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $product->update($this->validated($request));

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        try {
            $product->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Produk tidak bisa dihapus karena sudah ada di pesanan.');
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);
    }
}