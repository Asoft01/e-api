<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            // 'stock' => $this->stock,
            'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount' =>$this->discount,
            'totalPrice' => round((1- ($this->discount/100)) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'No rating yet',
            // 'rating' => round($this->reviews->sum('star') / $this->reviews->count(), 2),
            // 'rating' => $this->reviews->sum('star') / $this->reviews->count(),
            // 'rating_star' => $this->reviews->sum('star'),
            // 'rating' => $this->reviews,
            // 'count' => $this->reviews->count(),
            'href'=> [
                'reviews' => route('reviews.index', $this->id) 
            ]
        ];
    }
}
