<?php

namespace App\Http\Admin\Service\Services;

use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\Service\Repositories\ServiceRepository;
use App\Http\Admin\Service\Repositories\ServicePackageRepository;
use App\Http\Admin\Service\Resources\ServicePackageResource;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServicePackageService{
    public function create($request)
    {
        $package = isset($request->service_package_id) ? ServicePackage::find($request->get('service_package_id')) : [];
        if(isset($request->service_package_id) && empty($package))
            return redirect()->to('admin/packages')->with('error','Service Package not found');
        $services = Service::get();
        return view('_back.package.create', compact('package','services'));
    }
    public function serviceById($id) 
    {
        return ServicePackage::find($id);
    }
    public function upload($request)
    {
        if($request->hasFile('image') && $request->file('image') != null){
            $name=$request->file('image')->getClientOriginalName();  
            $path = "public/image/package/".$name;
            Storage::put($path, file_get_contents($request->file('image')));  
            return $name;
        }
        return null;
    }
    public function store($request)
    {
        $name = $this->upload($request);
        return ServicePackage::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'service_id'=>$request->service_id ?? null,
                'price'=>$request->price,
                'how_work'=>$request->how_work,
                'included'=>$request->included,
                'excluded'=>$request->excluded,
                'duration'=>$request->duration,
                'image'=> $name ?? ''
            ]);
        }
    public function update($request, $service)
    {
        return $service->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'service_id'=>$request->service_id ?? null,
            'price'=>$request->price,
            'how_work'=>$request->how_work,
            'included'=>$request->included,
            'excluded'=>$request->excluded,
            'duration'=>$request->duration,
            'image'=> $name ?? $service->image
        ]);
    }
    public function delete($service)
    {
        try {
            return $service->delete();
        } catch (\Exception $e) {
            return false; // Return false on error
        }
    }
    public function show($request)
    {
        $categories = ServicePackage::select('name','slug','description','price','service_id','included','excluded','how_work','duration','image')->with('service')->where(function($query)use($request){
            if(isset($request->service) && $request->service!= ''){
                $query->whereHas('service',function($service)use($request){
                    $service->where('slug',$request->service);
                });
            }
        })->get();
        return ServicePackageResource::collection($categories);   
    }
}