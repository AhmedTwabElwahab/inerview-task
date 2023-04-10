<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of Product.
     *
     * @return View
     */
    public function index(): View
    {
        $this->init();
        $products = Product::with(['category'])->paginate(APP_PAGINATE);
        return $this->view(compact('products'));
    }
    /**
     * Create New Product.
     *
     * @return View
     */
    public function create():View
    {
        $this->init();
        $categories  = Category::all();
        return $this->view(compact('categories'));
    }

    /**
     * store a new Product.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $product = new Product($request->all());
            if (!$product->save())
            {
                throw new Exception('error',APP_ERROR);
            }
            DB::commit();
            $this->success('success');
            return redirect()->route('product.index');

        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back();
        }
    }

    /**
     * edit exists product.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories  = Category::all();
        return $this->view(compact('product','categories'));
    }

    /**
     * update product info.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
           $res = $product->update($request->except('barcode'));

            if (!$res)
            {
                throw new Exception('error',APP_ERROR);
            }

            DB::commit();
            $this->success('success');
            return redirect()->route('product.index');
        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back();
        }
    }
}
