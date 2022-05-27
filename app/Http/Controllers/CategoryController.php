<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories(Request $request)
    {
        $query = $this->category->getCategories();
        if ($q = $request->input('q')) {
            $this->category->getByName($query, $q);
        }
        if ($sort = $request->input('sort')) {
            $query = $this->category->OrderById($query, $sort);
        }

        $perpage = $request->input('perpage', 5);
        $page = $request->input('page', 1);
        $total = $query->count();
        if ($perpage == 0) {
            $perpage = $total;
        }
        $result = $this->category->Offset($query, $page, $perpage);
        return response()->json(
            [
                'categories' => $result,
                'total' => $total,
                'page' => $page,
                'perpage' => $perpage,
                'q' => $q,
                'last_page' => ceil($total / $perpage),
            ],
            200,
        );
    }

    public function getCategoryById($id)
    {
        $category = $this->category->getById($id);
        if (is_null($category)) {
            return response()->json(['message' => 'loi xoa'], 404);
        }
        return response()->json(
            $category,
            200
        );
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = $this->category->getById($id);
        if (is_null($category)) {
            return response()->json(['message' => 'loi delete'], 404);
        }
        $category->delete();
        return response()->json(null, 204);
    }

    public function addCategory(Request $request)
    {
        $category = $this->category->createCategory($request->all());
        return response($category, 201);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = $this->category->getById($id);
        if (is_null($category)) {
            return response()->json(['message' => 'loi cập nhật'], 404);
        }
        $category->update($request->all());
        return response()->json($category, 200);
    }
}
