<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function listCategories()
    {
        return Category::with('parent')->select('categories.*');
    }

    public function getCategoryDropdownList($removeId = null)
    {
        $query = Category::query();

        if ($removeId) {
            $query->where('category_id', '!=', $removeId);
        }

        return $query->get();
    }

    public function storeCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $category->update($data);
    }

    public function deleteCategory(Category $category)
    {
        // Moving children to parent of the current category
        $category->children()->update(['parent_id' => $category->parent_id]);
        return $category->delete();
    }
}
