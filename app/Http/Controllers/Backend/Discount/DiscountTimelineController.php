<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Models\DiscountTimeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class DiscountTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines=request()->input('action') == 1 ? DiscountTimeline::latest()->get() : Inertia::lazy(fn ()=> DiscountTimeline::get());

        return Inertia::render("Backend/Timeline/Index", [
            "status"   => session('status') ?? null,
            "timelines" => $timelines,
        ]);
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
            'startTime'=> "required|date|after:today",
            'endTime'=> "required|date|after:startTime"
        ]);
        $startTime = Carbon::parse($request->startTime)->setTimezone('Asia/Yangon')->toDateTimeString();
        $endTime = Carbon::parse($request->endTime)->setTimezone('Asia/Yangon')->toDateTimeString();
        $timelines=DiscountTimeline::create([
            'start'=>$startTime,
            'end'=>$endTime
        ]);
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
        return Inertia::render('Backend/Timeline/Edit',[
            'timeline'=>$discountTimeline
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiscountTimeline $discountTimeline)
    {
        $validated = $request->validate([
            'startTime'=> "required|date|after:today",
            'endTime'=> "required|date|after:startTime"
        ]);
        $startTime = Carbon::parse($request->startTime)->setTimezone('Asia/Yangon')->toDateTimeString();
        $endTime = Carbon::parse($request->endTime)->setTimezone('Asia/Yangon')->toDateTimeString();
        $discountTimeline->start=$startTime;
        $discountTimeline->end=$endTime;
        $discountTimeline->update();
        return redirect()->route('discount_timelines.index')->with('status','updated Timeline successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountTimeline $discountTimeline)
    {
        $discountTimeline->delete();

        return redirect()->route('discount_timelines.index',['action'=>1])->with('status','Timeline is deleted successfully');
    }
}
