<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($images, $productId)
    {
        $files = [];
        foreach ($images as $image) {
            $image_name = time().rand(1, 99).'.'.$image->extension();
            $image->move(public_path('product_img'), $image_name);
            $path = "product_img/".$image_name;
            $files[]['path'] = $path;
        }

        // Create Product Images
        foreach ($files as $file) {
            ProductImage::create([
                "image"      => $file['path'],
                "product_id" => $productId,
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        $productImage->delete();
        return json_encode(['status'=> 'product-image-delete-success']);
    }
}
