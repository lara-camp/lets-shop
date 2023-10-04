<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Backend/Product/Index", [
            "status"   => session('status') ?? null,
            "products" => Inertia::lazy(function () {
                return Product::with('category')->get();
            }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Create Product
        $product = Product::create([
            "name"        => $request->name,
            "slug"        => Str::slug($request->name),
            "description" => $request->description,
            "truncate"    => Str::words($request->description, 30, "..."),
            "category_id" => $request->category,
            "price"       => $request->price,
            "stock"       => $request->stock,
        ]);

        // Create Product Details
        $productDetailController = new ProductDetailController();
        $productDetailController->store($request->details, $product->id);

        // Store Product Images
        if (isset($request->allFiles()['images'])) {
            $productImageController = new ProductImageController();
            $productImageController->store($request->allFiles()['images'], $product->id);
        }

        return redirect()->route('products.index')->with('status', 'product-create-success');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Backend/Product/Create", [
            "status" => session("status") ?? null,
        ]);
    }

    /**
     * Show the product detail with slug
     */
    public function detail($slug)
    {
        return Inertia::render("Backend/Product/Show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
