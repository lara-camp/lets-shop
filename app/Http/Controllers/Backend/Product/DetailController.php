<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = DB::table('details')->select('id', 'key')->get();

        return json_encode($details);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'key' => 'required|min:3|max:20|unique:details,key',
        ]);
        $detail = Detail::create([
            'key' => $request->key,
        ]);

        return json_encode([
            "status" => "new-detail-success",
            "key"    => $detail->key,
        ]);
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
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail $detail)
    {
        $key = $detail->key;
        $detail->delete();
        return json_encode(['status'=> 'detail-create-success', 'key' => $key]);
    }
}
