<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * show all product
     */
    function index(Category $categories)
    {
        $products = Product::all();
        $categories = Category::where('level', '=', 0);
        return view('product.index', [
            'products' => $products, 
            'categories' => $categories
        ]);
    }


    /**
     * Show the product form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form()
    {
        $categories = Category::withCount('products')->get();
        $this->get_states();
        return view('product.form', [
            'categories' => $categories,
            'keys' => $this->keys,
            'states' => $this->states
        ]);
    }


    function create()
    {
        $data = request()->validate([
            "cat_id"        => "required|integer",
            "brand_id"      => "",
            "model_id"      => "",
            "name"          => "required",
            "description"   => "string",
            "cond"          => "required",
            "color"         => "required",
            "receipt"       => "required",
            "age"           => "",
            "sn"            => "",
            "sn_type"       => "",
            "publish"       => "required",
            "price"         => "required",
            "initial_price" => "required",
            "repay_price"   => "required",
            "repay_period"  => 'required',
            "coupon"        => "",
            "discount"      => "",
            "free_days.*"   => "string",
            "fimage"        => 'required|image|max:5048'
        ]);

        $gallery = request()->validate(["gallery.*" => "required|image|max:5048", "free_days.*" => "string"]);
        $data['free_days'] = json_encode($data['free_days']);
        $data['owner_id'] = auth()->id();
        
        // save featured image
        $imagePath = request()->fimage->store('uploads/products', 'public');
        $data['fimage'] = $imagePath;

        // save product
        $product = Product::firstOrCreate($data);

        // store images
        foreach ($gallery['gallery'] as $image) {
            $imagePath = $image->store('uploads/products', 'public');
            ProductImage::create([
                'path' => $imagePath, 'product_id' => $product->id, 'owner_id' => auth()->id()
            ]);
        }

        return redirect('/p');
    }


    /**
     * render preview of a product
     */
    function preview_product(Product $product)
    {
        return view('product.preview', ['product' => $product]);
    }


    function profile(Product $product)
    {
        return view('product.profile', ['product' => $product]);
    }


    function categories(Category $cat)
    {
        $categories = Category::where('level', '=', 0)->get();
        return response()->json($categories);
        // return view('product.categories', ['categories' => $cat]);
    }


    function category_brands(Category $cat)
    {
        $brands = $cat->brands()->withCount('products')->get();
        return response()->json($brands);
    }

    
    function category_products(Category $cat)
    {
        $products = $cat->products()->get();
        return view('product.categories', ['products' => $products]);
    }


    function brand_models(Brand $brand)
    {
        $models = $brand->models()->withCount('products')->get();
        return response()->json($models);
    }

}
