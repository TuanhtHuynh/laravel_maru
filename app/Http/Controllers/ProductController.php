<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function get(Request $request)
    {
        $product_query = $this->product->getProductCategory();
        $cateName = "";
        if ($ctg_slug = $request->input('category_slug', '')) {
            $this->product->getByCategorySlug($product_query, $ctg_slug);
            $cateName = $ctg_slug;
        }
        if ($q = $request->input('q')) {
            $this->product->getProductByname($product_query, Str::lower($q));
        }
        $order = $request->input('order', 'id');
        if ($sort = $request->input('sort', 'desc')) {
            $product_query->orderBy($order, $sort);
        }

        $total = $product_query->count();
        $page = $request->input('page', 1);
        $perpage = $request->input('perpage', 5);
        if ($perpage == 0) {
            $perpage = $total;
        }

        $result = $product_query->offset(($page - 1) * $perpage)->limit($perpage)
            ->get();

        return response()->json(
            [
                'products' => $result,
                'total_item' => $total,
                'page' => $page,
                'perpage' => $perpage,
                'sort' => $sort,
                'q' => $q ? $q : '',
                'cateSlug' => $ctg_slug,
                'cateName' => $cateName,
                'last_page' => ceil($total / $perpage)
            ],
            200
        );
    }

    public function getLastDiscount(Request $request)
    {
        $product_query = $this->product->getProductCategory();
        if ($request->input('discount', true)) {
            $this->product->getDiscount($product_query);
        }
        if ($take = $request->input('take', 5)) {
            $this->product->getDiscountLast($product_query, $take);
        }
        $result = $product_query->get();
        return response()->json(['last_products' => $result], 200);
    }

    public function getByCategory(Request $request)
    {
        $product_query = $this->product->getProductCategory();
        if ($ctg_slug = $request->input('category', '')) {
            $category = $this->product->getCategoryProductBySlug($product_query, $ctg_slug)->get();
            $product_query->where('category_id', '=', $category[0]->id);
        }

        $total = $product_query->count();
        $page = $request->input('page', 1);
        $perpage = $request->input('perpage', 5);

        $result = $product_query->offset(($page - 1) * $perpage)->limit($perpage)
            ->get([
                'products.*',
            ]);
        return response()->json([
            'products' => $result,
            'cateSlug' => $ctg_slug,
            'page' => $page,
            'perpage' => $perpage,
            'last_page' => ceil($total / $perpage)
        ], 200);
    }

    public function getProductDetail_BySlug($category_slug, $product_slug)
    {
        if ($product_slug) {
            $product_detail = $this->product->getProductDetailBySlug($product_slug);
            return response()->json(
                [
                    'product_detail' => $product_detail->get([
                        'products.*'
                    ])
                ],
                200
            );
        }
    }

    public function edit($id)
    {
        try {

            $product = $this->product->getProductCategoryById($id)
                ->get([
                    'products.*',
                    'categories.id as category_id',
                    'categories.name as category_name'
                ])->first();

            return response()->json([
                'product' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'lỗi lấy thông tin sản phẩm'
            ]);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $product = $this->product->getProductById($id);
        if (is_null($product)) {
            return response()->json(
                [
                    'message' => 'loi cập nhật'
                ],
                404
            );
        }
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function addProduct(Request $request)
    {
        $product = $this->product->createProduct($request->all());
        return response($product, 201);
    }
}
