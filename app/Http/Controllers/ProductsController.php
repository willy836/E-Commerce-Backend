<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }
    
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;

        // Serialize the images array before saving
        // Explicitly cast the 'images' attribute to JSON since I am not casting in model
        $validatedData['images'] = json_encode($validatedData['images']);

        $product = Product::create($validatedData);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if(Auth::user()->id !== $product->user_id){
            return response()->json(['message' => 'You are not authorized to update the product'], 403);
        }

        $product->update($validatedData);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        if(Auth::user()->id !== $product->user_id){
            return response()->json(['message' => 'You are not authorized to delete this product'], 403);
        }

        $product->delete();

        return response(null, 204);
    }
}
