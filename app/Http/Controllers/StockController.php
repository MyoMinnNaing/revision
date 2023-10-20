<?php

namespace App\Http\Controllers;

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

        $productIds = Product::all()->pluck('id'); // return an array of id form product table

        $totalStock = 0;
        foreach ($productIds as $productId) {
            $totalStock = Stock::where('product_id', $productId)->sum('quantity');
            return response()->json([
                 'id' => $productId,
                 'total_stock' => $totalStock,
            ]);



        //    $totalStock =  Stock::where('product_id', $productId)->sum('quantity');
        }

        return $totalStock;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
