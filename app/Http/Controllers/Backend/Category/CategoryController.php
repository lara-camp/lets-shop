<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return request()->expectsJson() ? json_encode($categories) : Inertia::render('Backend/Category/Index', [
            "categories" => Inertia::lazy(
                fn () =>$categories
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        if ($request->parentCategory) {
            $category->parent_id = $request->parentCategory['id'];
        }
        $category->save();

        return json_encode([

            'status' => 'Created Successfully',
            'title'  => $request->title,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detail($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
