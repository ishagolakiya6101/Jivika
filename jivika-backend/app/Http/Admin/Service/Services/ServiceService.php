<?php

namespace App\Http\Admin\Service\Services;

use App\Http\Admin\Service\Repositories\ServiceRepository;
use App\Http\Admin\Service\Repositories\ServicePackageRepository;
use App\Http\Admin\Service\Resources\ServiceResource;
use App\Http\Admin\ServiceProvider\Services\ServiceProviderService;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    protected $serviceProviderService;
    public function __construct(ServiceProviderService $serviceProviderService)
    {
        $this->serviceProviderService = $serviceProviderService;
    }
    public function create($request)
    {
        $service = isset($request->service_id) ? Service::find($request->get('service_id')) : [];
        if (isset($request->service_id) && empty($service))
            return redirect()->to('admin/services')->with('error', 'Service not found');
        $categories = Category::get();
        return view('_back.service.create', compact('categories', 'service'));
    }
    public function upload($request)
    {
        if ($request->hasFile('image') && $request->file('image') != null) {
            $name = $request->file('image')->getClientOriginalName();
            $path = "public/image/service/" . $name;
            Storage::put($path, file_get_contents($request->file('image')));
            return $name;
        }
        return null;
    }
    public function serviceById($id)
    {
        return Service::find($id);
    }
    public function store($request)
    {
        $name = $this->upload($request);
        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id ?? null,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'image' => $name ?? ''
        ]);
        return $service;
    }
    public function update($request, $service)
    {
        $name = $this->upload($request);
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id ?? null,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'image' => $name ?? $service->image
        ]);
        return $service;
    }
    public function delete($service)
    {
        try {
            return $service->delete();
        } catch (\Exception $e) {
            return false; // Return false on error
        }
    }
    public function serviceList($request)
    {
        $service = Service::select(['id','slug','name'])->get();
        return $service;
    }
    public function show($request)
    {
        $services = Service::with(['category', 'provider'])->where(function ($query) use ($request) {
            if ($request->has('category') && $request->category != null)
                $query->whereHas('category', function ($category) use ($request) {
                    $category->where('slug', $request->category);
                });
        })->whereHas('provider', function ($data) use ($request) {
            $data->whereHas('address', function ($address) use ($request) {
                if ($request->has('latitude') && $request->has('longitude') && $request->longitude != null && $request->latitude != null) {
                    $location = $this->serviceProviderService->getNearbyLocations($request);
                    $address->whereBetween('latitude', [$location["minLat"], $location["maxLat"]])
                        ->whereBetween('longitude', [$location["minLon"], $location["maxLon"]]);
                }
            });
        })->get();
        if ($services->isEmpty()) {
            $services = Service::with(['category', 'provider'])->where(function ($query) use ($request) {
                if ($request->has('category') && $request->category != null)
                    $query->whereHas('category', function ($category) use ($request) {
                        $category->where('slug', $request->category);
                    });
            })->get();
        }
        return ServiceResource::collection($services);
    }
    public function serviceDetail($request)
    {
        $services = Service::whereSlug($request->slug)->first();
        return new ServiceResource($services);
    }
}
