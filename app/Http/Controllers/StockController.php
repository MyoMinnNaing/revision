<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {

        $stock = Stock::create([
             'user_id' => 1,
             "product_id" => $request->product_id,
             "quantity" => $request->quantity,

        ]);

        $totalStock = Stock::where('product_id', $request->product_id)->sum('quantity');

        $product = Product::find($request->product_id);
        $product->total_stock = $totalStock;
        $product->save();

        return response()->json([
            $stock
        ]);

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
