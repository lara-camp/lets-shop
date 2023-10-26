<?php

namespace App\Http\Controllers\Backend\Review;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
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
    public function store(Request $request)
    {
        // return ($request);
        $request->validate([
            "content" => 'required|max:300',
        ]);

        Review::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'parent_id' => $request->parent_id ?? null,
            'content' => $request->content
        ]);

        return redirect()->back();
    }

    public function reply(Request $request)
    {
        $request->validate([
            "content" => 'required|max:300',
        ]);

        Review::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'parent_id' => $request->parent_id ?? null,
            'content' => $request->replyContent
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'content' => 'required|max:300',
        ]);
        $review->update([
            'content' => $request->content,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back();
    }
}
