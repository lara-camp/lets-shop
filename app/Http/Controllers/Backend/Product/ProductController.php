<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\UpdateProductDetailRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductImageRequest;

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
        $product->productImages;
        $product->category;
        $product->productDetails;
        $data = [
            "product"    => $product,
            "details"    => Detail::all(),
            "categories" => Category::all(),
        ];

        return Inertia::render("Backend/Product/Edit", [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct(Request $request,
        UpdateProductRequest $updateProductRequest,
        UpdateProductDetailRequest $updateProductDetailRequest,
        StoreProductImageRequest $storeProductImageRequest,
        ProductImageController $productImageController,
        ProductDetailController $productDetailController)
    {
        $product = Product::find($request->id);
        // Edit Product
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->truncate = Str::words($request->description, 30, "...");
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        // Edit Product Details
        $productDetailController->update($request->details, $product->id);

        // Store Product Images
        if (isset($request->allFiles()['images'])) {
            $productImageController->store($request->allFiles()['images'], $product->id);
        }

        return redirect()->route('products.index')->with('status', 'product-update-success');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request,
        StoreProductDetailRequest $detailRequest,
        StoreProductImageRequest $storeProductImageRequest,
        ProductImageController $productImageController,
        ProductDetailController $productDetailController)
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
        $productDetailController->store($request->details, $product->id);

        // Store Product Images
        if (isset($request->allFiles()['images'])) {
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
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return redirect()->route('products.index')->with('success', 'product-delete-success');

    }
}
