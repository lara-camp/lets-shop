<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\ProductDetail;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function update($details, $productId)
    {
        if ($details) {
            foreach ($details as $detail) {
                if (!isset($detail['product_id'])) {
                    ProductDetail::create([
                        'detail_id'  => $detail['detail_id'],
                        'value'      => $detail['value'],
                        'product_id' => $productId,
                    ]);
                } else {
                    $productDetail = ProductDetail::find($detail['id']);
                    $productDetail->value = $detail['value'];
                    $productDetail->detail_id = $detail['detail_id'];
                    $productDetail->save();
                }
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDetail $productDetail)
    {
        $productDetail->delete();
        return json_encode(['status'=> 'product-detail-delete-success']);
    }
}
