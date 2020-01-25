<?php

namespace App\Http\Controllers;

use App\Product;
use App\Setting;
use App\Quantity;
use App\ProductDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class AdminController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $products = Product::all();
//        return view('admin')->with(['products'=>$products]);
        $products = Product::paginate(15);
        $vat = (new Setting())->getVATSize();
        return view('admin')->with(['products' => $products, 'vat' => $vat]);
    }

    /**
     * @param int $id
     * @return int
     */
    public function show(int $id)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'sku' => 'required',
            'name' => 'required',
            'img' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        // Add Product
        $product = new Product;
        $product->sku = $request->input('sku');
        $product->name = $request->input('name');
        $product->img = $request->input('img');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->visible = $request->input('visible');
        $product->save();

        $quantity = new Quantity;
        $quantity->value = $request->input('quantity');
        $product->quantity()->save($quantity);

        $discount = new ProductDiscount;
        $discount->value = $request->input('discount');
        $product->discount()->save($discount);

        return redirect()
            ->route('admin.index')
            ->with('status', 'New product successfully added!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.index');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'sku' => 'required',
            'name' => 'required',
            'img' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $product = Product::find($id);
        // Update Product
        $product->sku = $request->input('sku');
        $product->name = $request->input('name');
        $product->img = $request->input('img');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->visible = $request->input('visible');

        $product->save();

        return redirect()
            ->route('admin.index')
            ->with('status', 'Product details successfully updated!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        return view('edit')->with('product', $product);
    }


    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeVisibility(Request $request, int $id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return back()->withErrors(['wrong product id']);
        }
        $product->visible = $product->visible === 1 ? 0 : 1;
        $product->save();
        return back()->with('message', 'visibility changed');
    }
}
