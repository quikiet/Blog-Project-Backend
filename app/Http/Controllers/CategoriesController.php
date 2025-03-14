<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use Exception;
use Illuminate\Http\Request;
use function PHPUnit\Framework\throwException;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $category = categories::all();
            return $category;
        } catch (Exception $e) {
            return response()->json([
                "message" => "error",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateFields = $request->validate([
                'name' => 'required | max:255|unique:categories'
            ]);

            $category = categories::create($validateFields);

            return $category;
        } catch (Exception $e) {
            return response()->json([
                "message" => "error",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $category = categories::findOrFail($id);
            return $category;
        } catch (Exception $e) {
            return response()->json([
                "message" => "error",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validateFields = $request->validate([
                'name' => 'required|unique:categories'
            ]);

            $categories = categories::findOrFail($id);
            if (!$categories) {
                return response()->json(['message' => 'Danh mục không tồn tại!'], 404);
            }
            $categories->update($validateFields);

            return response()->json([
                'message' => 'Cập nhật danh mục thành công!',
                'category' => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Đã xảy ra lỗi khi cập nhật danh mục!",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categories = categories::findOrFail($id);
            $categories->delete();
            return ["message" => "delete"];
        } catch (Exception $e) {
            return response()->json([
                'message' => "Đã xảy ra lỗi khi cập nhật danh mục!",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
