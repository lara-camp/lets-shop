<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=request()->input('action') == 1 ? Coupon::latest()->get() :Inertia::lazy(fn ()=> Coupon::get());

        return Inertia::render("Backend/Coupon/Index", [
            "status"   => session('status') ?? null,
            "coupons" => $coupons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Backend/Coupon/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'    => 'required|min:5|max:10|unique:coupons,coupon_code',
            'discount' => 'required|numeric',
            'min_purchase'=>'required|numeric'
        ],[
            'code.unique'=>'Code already existed',
        ]);
        $coupon=Coupon::create([
            'coupon_code'=>$request->code,
            'discount'=>$request->discount,
            'min_purchase'=>$request->min_purchase
        ]);
        return redirect()->route('coupons.index')->with('status','Coupon code is created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($coupon_code)
    {
        $coupon=Coupon::where('coupon_code',$coupon_code)->firstOrFail();
        return Inertia::render('Backend/Coupon/Show',[
            'coupon'=>$coupon
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return Inertia::render('Backend/Coupon/Edit',[
            'coupon'=>$coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code'    => 'required|min:5|max:10|unique:coupons,coupon_code',
            'discount' => 'required|numeric',
            'min_purchase'=>'required|numeric'
        ],[
            'code.unique'=>'Code already existed',
        ]);
        $coupon->coupon_code=$request->code;
        $coupon->discount=$request->discount;
        $coupon->min_purchase=$request->min_purchase;
        $coupon->update();

        return redirect()->route('coupons.index')->with('status','Coupon code is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index',['action'=>1])->with('status','Coupon code is deleted successfully');
    }
}
