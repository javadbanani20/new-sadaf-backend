<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function StoreProduct(StoreProductRequest $storeProductRequest)
    {
        Product::create([
            'name'=>$storeProductRequest->name,
            'price'=>$storeProductRequest->price,
            'caption'=>$storeProductRequest->caption,
            'tittle'=>$storeProductRequest->tittle,
        ]);

    }
}
