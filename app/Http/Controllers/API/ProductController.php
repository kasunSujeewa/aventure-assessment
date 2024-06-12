<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getProducts();
        return $this->sendSuccess('Product Received Successfully', $products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return $this->sendSuccess('Product Created Successfully', $product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->productService->getProduct($id);
        return $this->sendSuccess('Product Received Successfully', $products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = $this->productService->updateProduct($id, $request->validated());
        return $this->sendSuccess('Product Updated Successfully', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->removeProduct($id);
        return $this->sendSuccess('Product Deleted Successfully');
    }
}
