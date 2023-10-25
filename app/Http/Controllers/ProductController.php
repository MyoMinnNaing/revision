<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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


        $products = Product::latest('id')->paginate(10)->withQueryString();

        return $products;
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


        if($request->total_stock > 0) {
            Stock::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $product->total_stock,

           ]);
        }



        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            abort(404, 'product not found');
        }

        return $product;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {


        $product = Product::find($id);
        if (is_null($product)) {
            abort(404, 'product not found');
        }

        $product->update([
            'name' => $request->name,
            'actual_price' => $request->actual_price,
            'sale_price' => $request->sale_price,
            // 'total_stock' => $request->total_stock,
            'brand_id' => $request->brand_id,
            'photo' => $request->photo,
            'unit' => $request->unit,
        ]);


        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        $product = Product::find($id);
        if (is_null($product)) {
            abort(404, 'product not found');
        }

        $product->delete();

        return response()->json([
            'message' => 'product has been deleted',
        ]);
    }
}
