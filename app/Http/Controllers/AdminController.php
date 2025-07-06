<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

    /**
     * Display a listing of the brands.
     */

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

    /**
     * Display a listing of the categories.
     */

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
            'parent_id' => 'nullable|exists:categories,id',
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

    /**
     * Display a listing of the products.
    */
    public function products()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function add_product()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.add_product', compact('categories', 'brands'));
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'short_description' => 'nullable|max:500',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric|lt:regular_price',
            'SKU' => 'required|max:100',
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price ?? null;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();

            $this->generateThumbnail($image, $file_name, 'products', 400, 400);
            $product->image = $file_name;
        }

        $gallery = [];
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file_name = time() . '-' . $counter . '.' . $image->getClientOriginalExtension();
                $this->generateThumbnail($image, $file_name, 'products', 400, 400);
                $gallery[] = $file_name;
                $counter++;
            }
            $gallery_images = implode(',', $gallery);
        }
        $product->images = $gallery_images;

        if ($request->has('category_id')) {
            $product->category_id = $request->category_id;
        }

        if ($request->has('brand_id')) {
            $product->brand_id = $request->brand_id;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found!');
        }
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.edit_product', compact('product', 'categories', 'brands'));
    }

    public function update_product(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'SKU' => 'required|max:100',
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = Product::findOrFail($request->id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price ?? null;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->featured = $request->featured ?? 0;
        $product->short_description = $request->short_description ?? '';

        if ($request->hasFile('image')) {
            if (File::exists(public_path('/uploads/products/' . $product->image))) {
                File::delete(public_path('/uploads/products/' . $product->image));
            }
            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $this->generateThumbnail($image, $file_name, 'products', 400, 400); // gunakan ukuran 400x400
            $product->image = $file_name;
        }
        if ($request->hasFile('images')) {
            $gallery = [];
            $counter = 1;
            foreach ($request->file('images') as $image) {
                $file_name = time() . '-' . $counter . '.' . $image->getClientOriginalExtension();
                $this->generateThumbnail($image, $file_name, 'products', 400, 400);
                $gallery[] = $file_name;
                $counter++;
            }
            $product->images = implode(',', $gallery);
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found!');
        }

        if (File::exists(public_path('/uploads/products/' . $product->image))) {
            File::delete(public_path('/uploads/products/' . $product->image));
        }

        if ($product->images) {
            $gallery = explode(',', $product->images);
            foreach ($gallery as $img) {
                $img = trim($img);
                if ($img && File::exists(public_path('/uploads/products/' . $img))) {
                    File::delete(public_path('/uploads/products/' . $img));
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }


    /**
     * Generate a thumbnail for the given image.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $image_name
     * @param string $folder
     * @param int $width
     * @param int $height
     */

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
