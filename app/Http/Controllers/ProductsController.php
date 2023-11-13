<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }
    
    public function store(StoreProductRequest $request)
    {
        // if(!Gate::allows('admin')){
        //     abort(403);
        // }
        $this->authorize('admin');

        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;

        // Serialize the images array before saving
        // Explicitly cast the 'images' attribute to JSON since I am not casting in model
        $validatedData['images'] = json_encode($validatedData['images']);

        $product = Product::create($validatedData);

        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('admin');

        $validatedData = $request->validated();

        $product->update($validatedData);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('admin');

        $product->delete();

        return response(null, 204);
    }
}
