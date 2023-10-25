<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    // public static $wrap = 'products';

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             "data" => ProductResource::collection($this->collection),
            //  "data" => $this->collection,
            //  'links' => [
            //     'self' => 'link-value',
            // ],
        ];
    }
}
