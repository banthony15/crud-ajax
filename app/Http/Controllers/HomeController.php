<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();
        return view('home', compact('products'));
    }

    public function destroyProduct(Request $request, $id)
    {
        if($request->ajax())
            $product = Product::find($id);
            $product->delete();
            $products_total = Product::all()->count();

            return response ()->json([
                'total' => $products_total,
                'message' => $product->name . 'fue eliminado correctamente'
        ]);
    }
}
