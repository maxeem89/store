<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;
use App\Utils\ImageUpload;

class ProductRepository implements InterfaceRepository

{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addColor($product, $params)
    {

        $product->productColor()->createMany($params['colors']);
    }

    public function baseQuery($relations = [], $withCount = [])
    {

        $query = $this->product->select('*')->with($relations);
        foreach ($withCount as $key => $value) {

            $query->withCount($value);
        }
        return $query;
    }

    public function getById($id)
    {
        $query = $this->product->where('id', $id)->firstOrfail();
        return $query;
    }

    public function store($params)
    {

        $product = $this->product->create($params);
        $images = $this->uploadMultipleImages($params, $product);
        $product->images()->createMany($images);
        return $product;
    }

    public function update($id, $params)
    {
        $product = $this->getById($id);
        $product=  $product->update($params);
        $product = $this->getById($id);
        $images = $this->uploadMultipleImages($params, $product);
        $product->images()->createMany($images);
        return $product;
    }

    private function uploadMultipleImages($params, $product)
    {
        $images = [];
        if (isset($params['images'])) {
            $count = 0;
            foreach ($params['images'] as $key => $value) {
                $images[$count]['image'] = ImageUpload::uploadImage($value);
                $images[$count]['parent_id'] = $product->id;
                $count++;
            }
        }
        return $images;

    }

    public
    function delete($id)
    {
        $product = $this->getById($id);
        return $product->delete();
    }

}
