<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductUpdateResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function SayHello(){
        return 'hi';
    }
    public function StoreProduct(StoreProductRequest $storeProductRequest)
    {
        $product=Product::create($storeProductRequest->all());
        if ($storeProductRequest->hasFile('picture'))
        {
           $pictureUrl = Storage::putFile('/product',$storeProductRequest->picture);
           $product -> update([
               'url_picture'=>$pictureUrl
           ]);

        }
        return response()->json([
            'message' => 'لیست در سامانه درج گردید',
            'data'=> new ProductResource($product)
        ],'200');
       /* Product::create([
            'name'=>$storeProductRequest->name,
            'price'=>$storeProductRequest->price,
            'caption'=>$storeProductRequest->caption,
            'tittle'=>$storeProductRequest->tittle,
        ]);*/

    }

    public function show($id)
    {
        $product = Product::find($id);
       if ($product == null)
        {
            return response()->json(
                [
                    'message'=>'not found',
                ]
            ,404) ;
        }
        else
        {
            return response()->json(
                [
                    'message'=>'found',
                    'data'=> new ProductResource($product)

            ]);
        }
       /* return new ProductResource($product);*/
    }

    public function showList()
    {
        $products = DB::table('products')->simplePaginate('1');
       if ($products == null)
       {
           return response()->json(
               [
                   'message'=>'لیست محصولات پیدا نشد',
               ]
               ,404) ;
       }
       else
       {
           return response()->json(
               [
                   'message'=>'لیست محصولات پیدا شد',
                   'data'=>ProductResource::collection($products)

               ]);
       }



    }

    public function update(ProductUpdateRequest $productUpdateRequest,Product $product)
    {
    $product->update($productUpdateRequest->all());
    return response()->json([
        "message"=>'اطلاعات لیست بروزرسانی شد',
        "data"=>new ProductUpdateResource($product)
    ],200);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json([
            "message"=>'لیست موردنظر حذف شد',
        ],200);
    }
}
