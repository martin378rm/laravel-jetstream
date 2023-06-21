<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dotenv\Validator;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        $datas = Category::all();
        return view('admin.category', compact('datas'));
    }

    public function add_category(Request $request)
    {
        $data = new Category();
        $data->category_name = $request->input('category');
        $data->save();

        return redirect()->back()->with('message', 'Category berhasil ditambahkan');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'data category berhasil dihapus');
    }

    public function view_product()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;
        $request->validate([
            "title" => "required",
            "description" => "required",
            "image" => "required|image|mimes:svg,jpeg,png,jpg,gif|max:2048",
            "category_id" => "required",
            "quantity" => "required|min:1",
            "price" => "required|min:1"
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->price = $request->price;

        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product_img', $imageName);
        $product->image = $imageName;
        $product->save();



        return redirect()->back()->with('message', 'product berhasil ditambahkan');
    }

    public function show_product()
    {

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'category_name')->get();
        return view('admin.show_product', compact('products'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product berhasil dihapus');
    }

    public function update_product($id)
    {
        // $product = Product::find($id);
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'categories.category_name')
            ->first();

        $category = Category::all();

        return view('admin.update_product', compact('product', 'category'));
    }


    public function update_product_confirm($id, Request $request)
    {
        $product = Product::find($id);
        $request->validate([
            "title" => "required",
            "description" => "required",
            // "image" => "|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "category_id" => "required",
            "quantity" => "required|min:1",
            "price" => "required|min:1"
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->price = $request->price;

        $image = $request->image;

        if ($image != null) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product_img', $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product succesfully updated');
    }
}