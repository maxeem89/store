<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements InterfaceRepository
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getMainCategories()
    {
        return $this->category->where('parent_id', 0)->orWhere('parent_id', null)->get();
    }

    public function store($params)
    {
        return $this->category->create($params);
    }

    public function getById($id, $childrenCount = false)
    {
        $query = $this->category->where('id', $id);
        if ($childrenCount) {

            $query->withCount('child');
        }
        return $query->firstOrfail();
    }

    public function update($category, $params)
    {
        return $category->update($params);
    }

    public function delete($id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }

    public function baseQuery($relations = [])
    {
        $query = $this->category->select('*')->with($relations);
        return $query;
    }


}
