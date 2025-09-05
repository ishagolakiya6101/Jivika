<?php

namespace App\Http\Admin\Discount\Controllers;

use App\DataTables\DiscountDataTable;
use App\Http\Admin\Discount\Services\DiscountService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    protected $discountService;
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }
    public function index(DiscountDataTable $datatable)
    {
        return $datatable->render('_back.discount.index');
    }
    public function create(Request $request)
    {
        return $this->discountService->create($request);
    }
    public function store(Request $request)
    {
        try {
            if ($request->discount_id == null) {
                $validator = Validator::make($request->all(), [
                    'code' => 'required|unique:discounts,code',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'value' => 'required|numeric|between:0.00,99.99',
                    'type' => 'required',
                    'max_users_limit' => 'nullable|numeric|between:0,99999999999999',
                    'max_limit' => 'nullable|numeric|between:0,99999999999999',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->messages()->first();
                    return redirect()->back()->with('error', $messages);
                }
                $createService = DB::transaction(function () use ($request) {
                    $createService = $this->discountService->store($request);
                    return [
                        'createService' => $createService,
                    ];
                });
                if ($createService['createService']) {
                    DB::commit();
                    return redirect()->to('admin/discount')->with('success', __('discount.created'));
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'code' => 'required|unique:discounts,code,' . $request->discount_id . ',id',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'value' => 'required|numeric|between:0.00,99.99',
                    'type' => 'required',
                    'max_users_limit' => 'nullable|numeric|between:0,99999999999999',
                    'max_limit' => 'nullable|numeric|between:0,99999999999999',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->messages()->first();
                    return redirect()->back()->with('error', $messages);
                }
                $service = $this->discountService->discountById($request->discount_id);
                if (!$service) {
                    return redirect()->to('admin/discount')->with('error', __('discount.not_found'));
                }
                $updateService = DB::transaction(function () use ($request, $service) {
                    $updateService = $this->discountService->update($request, $service);
                    return [
                        'updateService' => $updateService,
                    ];
                });
                if ($updateService['updateService']) {
                    DB::commit();
                    return redirect()->to('admin/discount')->with('success', __('discount.updated'));
                }
            }
            DB::rollback();
            return redirect()->to('admin/discount')->with('error', __('discount.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Store Operation', request()->ip(), $e);
            return redirect()->to('admin/discount')->with('error', __('something_went_wrong'));
        }

    }
    public function delete(Request $request)
    {
        try {
            $category = $this->discountService->discountById($request->id);
            if (!$category) {
                return response()->json(['error' => __('discount.not_found')]);
            }
            $deleteService = DB::transaction(function () use ($category) {
                $deleteService = $this->discountService->delete($category);
                return [
                    'deleteService' => $deleteService,
                ];
            });
            if ($deleteService['deleteService']) {
                DB::commit();
                return response()->json(['success' => __('discount.deleted')]);
            }
            DB::rollback();
            return response()->json(['error' => __('discount.deleted.failed')]);
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Delete Operation', request()->ip(), $e);
            return response()->json(['error' => __('something_went_wrong')]);
        }
    }
    public function show(Request $request)
    {
        return $this->discountService->show($request);
    }
    public function discount_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_code' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->first();
            return response()->json(['error'=> $messages],422);
        }
        return $this->discountService->discount_details($request);
    }
}
