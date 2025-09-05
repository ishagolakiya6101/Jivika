<?php

namespace App\http\Admin\Service\Controllers;

use App\DataTables\ServicePackageDataTable;
use App\Http\Admin\Service\Services\ServicePackageService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicePackageController extends Controller
{
    protected $serviceService;
    public function __construct(ServicePackageService $serviceService)
    {
        $this->serviceService = $serviceService;
    }
    public function index(ServicePackageDataTable $datatable)
    {
        return $datatable->render('_back.package.index');
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
                'service_id' =>'required',
                'duration'=>'required',
                'price' => 'required|numeric|between:0.00,99999999999999.99',
            ]);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return redirect()->back()->with('error',$messages);
            }
            if ($request->service_package_id == null) {
                $createService = DB::transaction(function () use ($request) {
                    $createService = $this->serviceService->store($request);
                    return [
                        'createService' => $createService,
                    ];
                });
                if ($createService['createService']) {
                    DB::commit();
                    return redirect()->to('admin/packages')->with('success', __('package.created'));
                }
            } else {
                $service = $this->serviceService->serviceById($request->service_package_id);
                if (!$service) {
                    return redirect()->to('admin/packages')->with('error', __('package.not_found'));
                }
                $updateService = DB::transaction(function () use ($request, $service) {
                    $updateService = $this->serviceService->update($request, $service);
                    return [
                        'updateService' => $updateService,
                    ];
                });
                if ($updateService['updateService']) {
                    DB::commit();
                    return redirect()->to('admin/packages')->with('success', __('package.updated'));
                }
            }
            DB::rollback();
            return redirect()->to('admin/packages')->with('error', __('package.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Store Operation', request()->ip(), $e);
            return redirect()->to('admin/packages')->with('error', __('something_went_wrong'));
        }
    }
    public function delete(Request $request)
    {
        try {
            $category = $this->serviceService->serviceById($request->id);
            if (!$category) {
                return response()->json(['error' => __('package.not_found')]);
            }
            $deleteService = DB::transaction(function () use ($category) {
                $deleteService = $this->serviceService->delete($category);
                return [
                    'deleteService' => $deleteService,
                ];
            });
            if ($deleteService['deleteService']) {
                DB::commit();
                return response()->json(['success' => __('package.deleted')]);
            }
            DB::rollback();
            return response()->json(['error' => __('package.deleted.failed')]);
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Service - Delete Operation', request()->ip(), $e);
            return response()->json(['error' => __('something_went_wrong')]);
        }
    }
    public function show(Request $request)
    {
        return $this->serviceService->show($request);
    }
}
