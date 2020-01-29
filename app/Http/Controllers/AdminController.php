<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSpecification;
use App\Product;
use App\ProductSpecification;
use App\Setting;
use App\Quantity;
use App\ProductDiscount;
use App\Specification;
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
        $products = Product::paginate(15);
        $vat = (new Setting())->getVATSize();
        $globalDiscount = (new Setting())->getGlobalDiscount();
        $settingsAvailable = Setting::$availableSettings;
        return view('admin')->with(['products' => $products, 'vat' => $vat, 'settingsAvailable' => $settingsAvailable, 'globalDiscount' => $globalDiscount]);
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
            'sku' => 'required|unique:products',
            'name' => 'required',
            'img' => 'required',
            'description' => 'required',
            'price' => 'required|int'
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
        ProductSpecification::where(['product_id' => $id])->delete();
        Quantity::where(['product_id' => $id])->delete();
        ProductDiscount::where(['product_id' => $id])->delete();
        Product::where('id', $id)->delete();

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
            'name' => 'required',
            'img' => 'required',
            'description' => 'required',
            'price' => 'required|int'
        ]);


        $product = Product::find($id);
        // Update Product
        $product->name = $request->input('name');
        $product->img = $request->input('img');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->visible = $request->input('visible');
        $product->save();


        if ($request->input('quantity')) {
            $product->quantity()->save(new Quantity(['value' => $request->input('quantity')]));
        }

        if ($request->input('discount')) {
            $product->discount()->save(new ProductDiscount(['value' => $request->input('discount')]));
        }

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
        $specifications = Specification::all();
        if (!$product) {
            return redirect()->route('admin.index')->withErrors(['product not fount']);
        }
        return view('edit')->with(['product' => $product, 'specifications' => $specifications]);
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

    /**
     * @param AddSpecification $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSpecification(AddSpecification $request, int $id)
    {
        $values = $request->validated();
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return back()->withErrors(['product not found']);
        }
        ProductSpecification::updateOrInsert([
            'product_id' => $id,
            'specification_id' => $values['specification']
        ], ['specification_text' => $values['productSpecification']]);
        return back()->with('message', 'specification saved');
    }

    /**
     * @param int $pid
     * @param int $sid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeSpecification(int $pid, int $sid)
    {
        ProductSpecification::where(['product_id' => $pid, 'specification_id' => $sid])->delete();
        return back()->with('message', 'specification deleted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addNewSpecification(Request $request)
    {

        $this->validate($request, [
            'specification' => 'required',
        ]);

        // Add Specification
        $specification = new Specification;
        $specification->name = $request->input('specification');
        $specification->save();

        return back()->with('message', 'specification type saved');
    }

    public function saveSetting(Request $request)
    {
        $this->validate($request, [
            'settingName' => 'required',
            'newValue' => 'required|int'
        ]);
        Setting::updateOrInsert([
            'property' => $request->input('settingName'),
        ], ['value' => $request->input('newValue')]);
        return back()->with('message', 'setting saved');
    }

}
