<?php

namespace App\Http\Admin\Setting\Repositories;

use App\Models\Setting;

class SettingRepository{
    
    public function update($request)
    {
        if($request->has('name') && $request->name != null)
        { 
            Setting::updateOrCreate(['key_name'=>'site_name'],[
                'key_value'=>$request->name
            ]);
        }
        if($request->hasFile('bg_image') && $request->file('bg_image') != null)
        {
            Setting::updateOrCreate(['key_name'=>'bg_image'],[
                'key_value'=>base64_encode(file_get_contents($request->file('bg_image')))
            ]);
        }
        if($request->hasFile('logo') && $request->file('logo') != null)
        {
            Setting::updateOrCreate(['key_name'=>'logo'],[
                'key_value'=>base64_encode(file_get_contents($request->file('logo')))
            ]);
        }
        if($request->hasFile('favicon') && $request->file('favicon') != null)
        {
            Setting::updateOrCreate(['key_name'=>'favicon'],[
                'key_value'=>base64_encode(file_get_contents($request->file('favicon')))
            ]);
        }
        return back()->with('success','settings updated');
    }
}