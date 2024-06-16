<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function __construct(private Product $product)
    {
        $this->product = new Product();
    }
    public function getProducts()
    {
        // get all Products
        return  $this->product->orderBy('created_at', 'desc')->get();
    }
    public function getProduct($id)
    {
        //show Product
        return  $this->product->find($id);
    }
    public function createProduct($data)
    {
        //create product
        $created_product = $this->product->create($data);
        return $created_product;
    }
    public function updateProduct($id, $data)
    {
        $product = $this->getProduct($id);
        if ($product == null) {
            return false;
        }
        //update product
        $product->update($data);
        return $this->getProduct($id);
    }
    public function removeProduct($id)
    {
        $product = $this->getProduct($id);
        if ($product == null) {
            return false;
        }
        //delete product
        $this->product->findOrFail($id)->delete();
        return true;
    }
}
