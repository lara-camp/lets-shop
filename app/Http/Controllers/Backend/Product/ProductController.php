<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Backend/Product/Index", [
            "status" => session('status') ?? null,
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
        foreach ($request->details as $detail) {
            $detailId = $detail['key']['id'];
            ProductDetail::create([
                'detail_id'  => $detailId,
                'value'      => $detail['value'],
                'product_id' => $product->id,
            ]);
        }

        // Store Product Images
        $files = [];
        if ($request->allFiles()['images']) {
            foreach ($request->allFiles()['images'] as $file) {
                $file_name = time().rand(1, 99).'.'.$file->extension();
                $file->move(public_path('product_img'), $file_name);
                $path = "/product_img/".$file_name;
                $files[]['path'] = $path;
            }
        }
        // Create Product Images
        foreach ($files as $file) {
            $productImage = ProductImage::create([
                "image"      => $file['path'],
                "product_id" => $product->id,
            ]);
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
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
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
