<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProdructFormRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct() {

        $this->middleware('auth')->only(['create','edit','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::latest()->paginate(10);
     
        return view('products.index', compact('products'))
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdructFormRequest $request)
    {
        
        $request->validated();

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $request->image_path
        ]);
 
        return redirect()
            ->route('products.index')
            ->with('success', 'Product has successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProdructFormRequest $request, Product $product)
    {
        $request->validated();
 
        $product->update($request->all());
 
        return redirect()
            ->route('products.index')
            ->with('success', 'Product has successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
 
        return redirect()
            ->route('products.index')
            ->with('success', 'Product has successfully deleted.');
    }

    /**
     * Return the image path.
     *
     * @param  Illuminate\Http\Request;  $request
     * @return image_path
     */
    private function storeImage(Request $request)
    {
        $newImageName = uniqid() . '-' . $request->name . '.' . $request->photo->extension();
 
        return $request->photo->move(public_path('images'), $newImageName);
    }
}
