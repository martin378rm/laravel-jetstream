<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'category_name')->paginate(3);
        return view('home.userpage', compact('products'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            # code...
            return view('admin.home');
        } else {
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'category_name')->paginate(3);

            return view('home.userpage', compact('products'));
        }

    }

    public function product_details($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'categories.category_name')
            ->first();
        return view('home.product_detail', compact('product'));
    }
}