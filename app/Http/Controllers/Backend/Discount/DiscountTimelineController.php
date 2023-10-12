<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Models\DiscountTimeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Inertia\Inertia;

class DiscountTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Backend/Timeline/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Backend/Timeline/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'startTime'=> "required",
            'endTime'=> "required"
        ]);
        $startTimeline=new DateTime($request->startTime);
        $endTimeline=new DateTime($request->endTime);
        $timeline=new DiscountTimeline();
        $timeline->start=$startTimeline;
        $timeline->end=$endTimeline;
        $timeline->save();
        return redirect()->route('discount_timelines.index')->with('status','created Timeline successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountTimeline $discountTimeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountTimeline $discountTimeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiscountTimeline $discountTimeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountTimeline $discountTimeline)
    {
        //
    }
}
