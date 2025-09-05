<?php

namespace App\Http\Admin\Setting\Services;

use App\Http\Admin\Setting\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingService{
    protected $settingRepository;
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    public function update($request)
    {
        return $this->settingRepository->update($request);
    }

}