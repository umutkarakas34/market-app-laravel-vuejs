<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // GET /api/products
    public function index()
    {
        return Product::all();
    }

    // GET /api/products
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        Product::findOrFail($id);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }

}
