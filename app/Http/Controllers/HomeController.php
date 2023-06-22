<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use GuzzleHttp\Psr7\Message;
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

    public function add_cart(Request $request, $id)
    {
        $user = Auth::user();
        // jika user sudah login
        if ($user) {


            $product = Product::find($id);
            $cart = new Cart();

            try {

                DB::beginTransaction();

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;


                if ($product->discount_price != 0) {
                    $cart->price = $product->discount_price;
                } else {
                    $cart->price = $product->price;
                }

                if ($product->quantity >= $request->quantity) {
                    $cart->quantity = $request->quantity;

                    $product->quantity -= $request->quantity;
                    $cart->image = $product->image;
                    $cart->product_id = $product->id;
                    $cart->user_id = $user->id;

                    $cart->save();
                    $product->update();

                    DB::commit();
                }
                // return redirect('redirect')->with('message', 'stok tidak cukup');


            } catch (Exception $e) {
                DB::rollBack();
                return response()->json($e->getMessage());
            }

            return redirect()->back()->with('message', 'added to cart');


        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        return view('home.show_cart', compact('cart'));
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $product = Product::where('id', $cart->product_id)->first();
        $product->quantity += $cart->quantity;


        $product->save();
        $cart->delete();

        return redirect()->back();
    }
}