<?php

namespace App\Http\Controllers;

use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = Product::where('visible', 1)->paginate(2);
        return view('dashboard')->with(['products' => $products]);
    }


    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function productSelected(int $id, Request $request)
    {
        $product = Product::where('id', $id)->where('visible', 1)->first();
        if (!$product) {
            return redirect()->route('dashboard')->withErrors(['wrong product id']);
        }
        return view('product')->with(['product' => $product]);
    }
}
