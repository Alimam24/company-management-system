<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

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
            ]
        );

        product::create($attributes);

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
            ]
        );
        $product->update(
            [
                'name' => request('name'),
                'price' => request('price'),
                'description' => request('description'),

            ]
        );

        return redirect("/products/$product->id");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        // authenticat

        $product->delete();

        return redirect('/products');
    }
}
