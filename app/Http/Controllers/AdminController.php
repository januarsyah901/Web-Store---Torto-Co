<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function brands()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }

    public function add_brand()
    {
        return view('admin.add_brand');

    }

    public function store_brand(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        $image = $request->file('image');
        $file_extension = $image->getClientOriginalExtension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extension;

        $this->generateThumbnail($image, $file_name, 'brands', 124, 124);

        $brand->image = $file_name;
        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
    }

    public function edit_brand($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('admin.brands')->with('error', 'Brand not found!');
        }
        return view('admin.edit_brand', compact('brand'));
    }

    public function update_brand(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $brand = Brand::findOrFail($request->id);

        $this->updateThumbnailResource($request, $brand, 'brands', 124, 124);

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully!');
    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('admin.brands')->with('error', 'Brand not found!');
        }

        if (File::exists(public_path('/uploads/brands/' . $brand->image))) {
            File::delete(public_path('/uploads/brands/' . $brand->image));
        }

        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully!');
    }

    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));

    }

    public function add_category()
    {
        return view('admin.add_category');
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_extension = $image->getClientOriginalExtension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;

            $this->generateThumbnail($image, $file_name, 'categories', 200, 200);
            $category->image = $file_name;
        }

        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found!');
        }
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $category = Category::findOrFail($request->id);

        $this->updateThumbnailResource($request, $category, 'categories', 200, 200);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found!');
        }

        if (File::exists(public_path('/uploads/categories/' . $category->image))) {
            File::delete(public_path('/uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    public function generateThumbnail($image, $image_name, $folder, $width = 124, $height = 124): void
    {
        $destinationPath = public_path("/uploads/{$folder}");

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $img = Image::make($image->path());

        $img->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $image_name);
    }

    private function updateThumbnailResource($request, $model, $folder, $width, $height)
    {
        $model->name = $request->name;
        $model->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if (File::exists(public_path("/uploads/{$folder}/" . $model->image))) {
                File::delete(public_path("/uploads/{$folder}/" . $model->image));
            }

            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $this->generateThumbnail($image, $file_name, $folder, $width, $height);
            $model->image = $file_name;
        }

        $model->save();
    }



}
