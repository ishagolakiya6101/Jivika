<?php

namespace App\Http\Admin\Setting\Controllers;

use App\Http\Admin\Setting\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }
    public function index()
    {
        return view('_back.settings');
    }
    public function update(Request $request)
    {
        return $this->settingService->update($request);
    }
}
