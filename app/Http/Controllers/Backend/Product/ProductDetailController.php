<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($details, $productId)
    {
        if ($details) {
            foreach ($details as $detail) {
                $detailId = $detail['key']['id'];
                ProductDetail::create([
                    'detail_id'  => $detailId,
                    'value'      => $detail['value'],
                    'product_id' => $productId,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductDetail $productDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDetail $productDetail)
    {
        //
    }
}
