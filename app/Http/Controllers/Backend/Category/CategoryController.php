<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
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
        if(isset($request->parentCategory)){
            $category->parent_id= $request->parentCategory;
        }
        if($request->image){
            $image=$request->image;
            $image_name = time().rand(1, 99).'.'.$image->extension();
            $image->move(public_path('category_img'), $image_name);
            $path = "category_img/".$image_name;
            $category->image=$path;
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
    public function show(Category $category)
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
        $category->title=$request->title;
        $category->slug = Str::slug($request->title);
        if(!is_null($request->parentCategory) && $request->parentCategory == $request->id){
            return json_encode([
                'error'=>'Cannot select same category'
            ]);
        }elseif(isset($request->parentCategory)){
            $category->parent_id=$request->parentCategory;
        }
        if($request->image){
            $image=$request->image;
            $image_name = time().rand(1, 99).'.'.$image->extension();
            $image->move(public_path('category_img'), $image_name);
            $path = "category_img/".$image_name;
            $category->image=$path;
        }
        $category->update();
        return json_encode([
            'status' => 'Updated Successfully',
            'title'  => $request->title,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if(Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        return json_encode([
            'status' => 'Deleted Successfully',
            'title'  => $category->title,
        ]);
    }

    public function destroyImage($id)
    {
        $category=Category::find($id);
        if(Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        $category->image=null;
        $category->update();
    }
}
