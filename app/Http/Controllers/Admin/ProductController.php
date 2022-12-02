<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::with(['category', 'user'])->get();

        return view('pages.admin.product.index', [
            'products' => $products
        ]);
    }


    public function discount()
    {
        $products = Product::with(['user', 'category'])->get();

        return view('pages.admin.product.discount', [
            'products' => $products
        ]);
    }

    public function add_discount($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.product.add-discount', [
            'product' => $product,
            'categories' => $categories
        ]);
    }



    public function store_discount(Request $request, $id)
    {
        // Product::findOrFail($id)->update([
        //     'discount_price' => $request->discount_price,
        // ]);

        $data = $request->all();
        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('product-discount.index');
    }


    public function edit_discount($id)
    {
        $item = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.product.edit-discount', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function update_discount(ProductRequest $request, $id)
    {
        $request->validate([
            'discount_price' => 'required',
        ]);

        $data = $request->all();

        $item = Product::findOrFail($id);


        $item->update($data);

        return redirect()->route('product-discount.index');
    }

    public function destroy_discount($id)
    {
        Product::findOrFail($id)->update([
            'discount_price' => null
        ]);

        return redirect()->route('product-discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'users' => $users,
            'categories' => $categories
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
