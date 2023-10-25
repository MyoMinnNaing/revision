<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{

    public static $wrap = 'product_detail';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
              "product_name" => $this->name,
              "actual_price" =>$this->actual_price,
              "sale_price" => $this->sale_price,
              "brand" => $this->brand->name,
              "total_stock" => $this->total_stock

        ];
    }


    // public function with(Request $request)
    // {
    //     // return ['user' => Auth::user()->name];
    // }
}
