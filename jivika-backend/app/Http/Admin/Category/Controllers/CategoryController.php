<?php

namespace App\Http\Admin\Category\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Http\Admin\Category\Services\CategoryService;
use App\Traits\Logger;
use App\Traits\Response;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use Logger, Response;
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('_back.category.index');
    }
    public function create(Request $request)
    {
        return $this->categoryService->create($request);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return redirect()->back()->with('error', $messages);
            }
            if ($request->category_id == null) {
                $createCategory = DB::transaction(function () use ($request) {
                    $createCategory = $this->categoryService->store($request);
                    return [
                        'createCategory' => $createCategory,
                    ];
                });
                if ($createCategory['createCategory']) {
                    DB::commit();
                    return redirect()->to('admin/category')->with('success', __('category.created'));
                }
            } else {
                $category = $this->categoryService->categoryById($request->category_id);
                if (!$category) {
                    return redirect()->to('admin/category')->with('error', __('category.not_found'));
                }
                $updateCategory = DB::transaction(function () use ($request, $category) {
                    $updateCategory = $this->categoryService->update($request, $category);
                    return [
                        'updateCategory' => $updateCategory,
                    ];
                });
                if ($updateCategory['updateCategory']) {
                    DB::commit();
                    return redirect()->to('admin/category')->with('success', __('category.updated'));
                }
            }
            DB::rollback();
            return redirect()->to('admin/category')->with('error', __('category.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Category - Store Operation', request()->ip(), $e);
            return redirect()->to('admin/category')->with('error', __('something_went_wrong'));
        }
    }
    public function delete(Request $request)
    {
        try {
            $category = $this->categoryService->categoryById($request->id);
            if (!$category) {
                return response()->json(['error' => __('category.not_found')]);
            }
            $deleteCategory = DB::transaction(function () use ($category) {
                $deleteCategory = $this->categoryService->delete($category);
                return [
                    'deleteCategory' => $deleteCategory,
                ];
            });
            if ($deleteCategory['deleteCategory']) {
                DB::commit();
                return response()->json(['success' => __('category.deleted')]);
            }
            DB::rollback();
            return response()->json(['error' => __('category.deleted.failed')]);
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Category - Delete Operation', request()->ip(), $e);
            return response()->json(['error' => __('something_went_wrong')]);
        }
    }
    public function show(Request $request)
    {
        return $this->categoryService->show($request);
    }
}
