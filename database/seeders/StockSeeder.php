<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::factory()->count(20)->create();


        // Update total_stock of product table depend on quantity of stock table

        $productIds = Product::all()->pluck('id'); // return an array of id form product table
        foreach ($productIds as $productId) {
           $totalStock =  Stock::where('product_id', $productId)->sum('quantity'); // sum the column of quantity that specific product_id
           $product = Product::find($productId);
           $product->total_stock = $totalStock;
           $product->save();

        }
    }
}
