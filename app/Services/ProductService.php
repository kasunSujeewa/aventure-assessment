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
        return  $this->product->all();
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
        //update product
        $this->product->findOrFail($id)->update($data);
        return $this->getProduct($id);
    }
    public function removeProduct($id)
    {
        //delete product
        $this->product->findOrFail($id)->delete();
    }
}
