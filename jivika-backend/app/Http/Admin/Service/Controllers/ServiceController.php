<?php

namespace App\Http\Admin\Service\Controllers;

use App\DataTables\ServiceDataTable;
use App\Http\Admin\Service\Requests\ServiceDetailRequest;
use App\Http\Admin\Service\Services\ServiceService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    protected $serviceService;
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }
    public function index(ServiceDataTable $datatable)
    {
        return $datatable->render('_back.service.index');
    }
    public function create(Request $request)
    {
        return $this->serviceService->create($request);;
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'category_id' => 'required',
                'price' => 'required|numeric|between:0.00,99999999999999.99',
                'offer_price' => 'nullable|numeric|between:0.00,99999999999999.99',
            ]);
            if ($validator->fails()) {
                $messages = $validator->messages()->first();
                return redirect()->back()->with('error', $messages);
            }
            if ($request->service_id == null) {
                $createService = DB::transaction(function () use ($request) {
                    $createService = $this->serviceService->store($request);
                    return [
                        'createService' => $createService,
                    ];
                });
                if ($createService['createService']) {
                    DB::commit();
                    return redirect()->to('admin/services')->with('success', __('service.created'));
                }
            } else {
                $service = $this->serviceService->serviceById($request->service_id);
                if (!$service) {
                    return redirect()->to('admin/services')->with('error', __('service.not_found'));
                }
                $updateService = DB::transaction(function () use ($request, $service) {
                    $updateService = $this->serviceService->update($request, $service);
                    return [
                        'updateService' => $updateService,
                    ];
                });
                if ($updateService['updateService']) {
                    DB::commit();
                    return redirect()->to('admin/services')->with('success', __('service.updated'));
                }
            }
            DB::rollback();
            return redirect()->to('admin/services')->with('error', __('service.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Store Operation', request()->ip(), $e);
            return redirect()->to('admin/services')->with('error', __('something_went_wrong'));
        }
    }
    public function delete(Request $request)
    {
        try {
            $category = $this->serviceService->serviceById($request->id);
            if (!$category) {
                return response()->json(['error' => __('service.not_found')]);
            }
            $deleteService = DB::transaction(function () use ($category) {
                $deleteService = $this->serviceService->delete($category);
                return [
                    'deleteService' => $deleteService,
                ];
            });
            if ($deleteService['deleteService']) {
                DB::commit();
                return response()->json(['success' => __('service.deleted')]);
            }
            DB::rollback();
            return response()->json(['error' => __('service.deleted.failed')]);
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Delete Operation', request()->ip(), $e);
            return response()->json(['error' => __('something_went_wrong')]);
        }
    }
    public function show(Request $request)
    {
        return $this->serviceService->show($request);
    }
    public function serviceDetail(ServiceDetailRequest $request)
    {
        return $this->serviceService->serviceDetail($request);
    }
}
