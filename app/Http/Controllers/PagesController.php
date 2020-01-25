<?php

namespace App\Http\Controllers;

use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {


//        $set = new Setting();
//        $generateRandomVat = random_int(15, 99);
//        $oldVat = $set->getVATSize();
//        $set->saveVAT($generateRandomVat);
//        $newVat = $set->getVATSize();
//        return  'OLD VAT value: '.$oldVat.'<br />New VAT value: '.$newVat. "<br /> REFRESH TO CHANGE";

        $products = Product::all();
//        $products = Product::orderBy('id','desc');
        return view('dashboard')->with(['products'=>$products]);
//        return view('dashboard')->with('products', $products);
    }

    public function productSelected($id)
    {
        $product = Product::where('id', $id)->first();
//        return view('product', compact('product'));
        return view('product')->with(['product'=>$product]);;
    }
}
