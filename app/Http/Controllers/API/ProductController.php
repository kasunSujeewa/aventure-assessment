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
        if($product['error'])
        {
            return $this->sendError($product['data'], [], 500);
        }
        else
        {
            
            return $this->sendSuccess('Product Created Successfully', $product['data'], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->productService->getProduct($id);
        if ($products == null) {
            return $this->sendError('Product Not Found', [], 404);
        }
        return $this->sendSuccess('Product Received Successfully', $products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = $this->productService->updateProduct($id, $request->validated());
        if ($product['error']) {
            return $this->sendError($product['data'], [], 404);
        }
        return $this->sendSuccess('Product Updated Successfully', $product['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->removeProduct($id);
        if (!$product) {
            return $this->sendError('Product Not Found', [], 404);
        }
        return $this->sendSuccess('Product Deleted Successfully');
    }
}
