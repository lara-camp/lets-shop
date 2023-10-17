<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HotSlide;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        //        Auth::logout();

        $products = Product::with(['productImages', 'category'])->get();

        $formattedProducts = $products->map(function ($product) {
            $formattedProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'truncate' => $product->truncate,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'category' => $product->category->title,
            ];
            if ($product->productImages->isNotEmpty()) {
                $formattedProduct['image'] = $product->productImages->first()->image;
            }
            return $formattedProduct;
        });

        return Inertia::render('Frontend/Home', [
            'slides' => HotSlide::where('is_show', '1')->latest()->get(),
            'products' => $formattedProducts
        ]);
    }
    public function shop()
    {
    }
    public function category()
    {
    }
    public function detail(Product $product){
        $product = [
            'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'truncate' => $product->truncate,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'category' => $product->category->title,
                'images' => $product->productImages,
                'details' => $product->productDetails,
        ];

        // return response()->json($product);
        return Inertia::render('Frontend/Detail',[
            'product' => $product,
        ] );
    }
    public function flashsale()
    {
    }
    public function contact()
    {
    }
}
