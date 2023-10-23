<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {


        $product = Product::create([
             'name' => $request->name,
             'actual_price' => $request->actual_price,
             'sale_price' => $request->sale_price,
             'brand_id' => $request->brand_id,
             'total_stock' => $request->total_stock,
             'photo' => $request->photo,
             'unit' => $request->unit,
        ]);


        Stock::create([
             'user_id' => Auth::user()->id,
             'product_id' => $product->id,
             'quantity' => $product->total_stock,

        ]);


        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
