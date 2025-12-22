<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start a query on the Product model
        $query = Product::query();

        // Search by product name
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by minimum price
        if ($minPrice = $request->input('min_price')) {
            $query->where('price', '>=', $minPrice);
        }

        // Filter by maximum price
        if ($maxPrice = $request->input('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        // Paginate results (10 per page)
        $products = $query->paginate(10)->withQueryString();

        // Return view
        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'name' => ['required', 'min:5'],
                'price' => ['required', 'gte:0'],
                'description' => ['required'],
                'avatar' => ['nullable', 'image'],
            ]
        );
        if ($request->hasFile('avatar')) {
            $avatar_url = request('avatar')->store('products', 'public');
        }

        product::create([
            'name' => $attributes['name'],
            'price' => $attributes['price'],
            'description' => $attributes['description'],
            'avatar_url' => $avatar_url ?? 'products/default.jpg',
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        // Eager load retail stores and warehouses with pivot data
        $product->load(['retail_stores', 'warehouses']);

        return view('products.show', ['product' => $product]);
    }

    public function edit(product $product)
    {

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        request()->validate(
            [
                'name' => ['required', 'min:5'],
                'price' => ['required', 'gte:0'],
                'description' => ['required'],
                'avatar' => ['nullable', 'image'],
            ]);

        // Only store a new avatar if the user uploaded one
        if ($request->hasFile('avatar')) {
            // Optionally delete old avatar if it exists
            if ($product->avatar_url) {
                Storage::disk('public')->delete($product->avatar_url);
            }
            // Store new avatar
            $avatar_url = $request->file('avatar')->store('avatars', 'public');
        } else {
            // Keep existing avatar URL if no new file is uploaded
            $avatar_url = $product->avatar_url;
        }

        $product->update(
            [
                'name' => request('name'),
                'price' => request('price'),
                'description' => request('description'),
                'avatar_url' => $avatar_url,

            ]
        );

        return redirect("/products/$product->id");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if($product->warehouses()->exists() || $product->retail_stores()->exists()){
            return redirect("/products/$product->id")->withErrors(['error' => 'Cannot delete product associated with warehouses or retail stores.']);
        }
        $product->delete();

        return redirect('/products');
    }
}
