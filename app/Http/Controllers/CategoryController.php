<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of Category.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        $categories = Category::paginate(APP_PAGINATE);
        return $this->view(compact('categories'));
    }

    /**
     * Create New category.
     *
     * @return View
     */
    public function create(): View
    {
       return $this->view();
    }

    /**
     * Store a new Category.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $category = new Category($request->all());

            if (!$category->save())
            {
                throw new Exception('error',APP_ERROR);
            }

            DB::commit();
            $this->success('success_add');
            return redirect()->route('category.index');

        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back()->withInput();
        }
    }

    /**
     * show edit page.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
       return $this->view(compact('category'));
    }

    /**
     * Update category.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $category->update($request->all());

            if (!$category->save())
            {
                throw new Exception('error',APP_ERROR);
            }

            DB::commit();
            $this->success('success_update');
            return redirect()->route('category.index');
        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            if ($category->products->isNotEmpty())
            {
                throw new Exception('delete_error' ,APP_ERROR);
            }

            if (!$category->delete())
            {
                throw new Exception('delete_error' ,APP_ERROR);
            }
            DB::commit();
            $this->success('success_delete');
            return redirect()->route('category.index');
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back();
        }
    }
}
