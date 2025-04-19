<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->categoryService->listCategories();

            return DataTables::of($query)
                ->addColumn('parent_name', function ($row) {
                    return $row->parent->name ?? 'None';
                })
                ->addColumn('status_text', function ($row) {
                    return $row->status == 1 ? 'Enabled' : 'Disabled';
                })
                ->addColumn('full_path', function ($row) {
                    return $row->fullPath();
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="' . route('categories.edit', $row->id) . '" class="edit-icon">Edit</a>';
                    $delete = '<form action="' . route('categories.destroy', $row->id) . '" method="POST" style="display:inline;">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<button type="submit">Delete</button></form>';
                    return $edit . ' ' . $delete;
                })
                ->addColumn('created_at', function ($category) {
                    return Carbon::parse($category->created_at)->format('d M Y, h:i A');
                })
                ->addColumn('updated_at', function ($category) {
                    return Carbon::parse($category->updated_at)->format('d M Y, h:i A');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categories.index');
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoryDropdownList();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        //dd($request->all());

        $this->categoryService->storeCategory($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $categories = $this->categoryService->getCategoryDropdownList($category->category_id);
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryService->updateCategory($category, $validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
