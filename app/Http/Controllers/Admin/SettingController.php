<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Services\Admin\Setting\SettingService;

class SettingController extends Controller
{
    public function __construct(
        private SettingService $settingService
    ){}

    public function index(){
        $data = $this->settingService->get();
        return view('admin.setting.index', compact('data'));
    }

    public function update(SettingRequest $request){
        $result = $this->settingService->update($request->validated());
        if(!$result){
            return redirect()->back()->withErrors(['error'=>'data not updated']);
        }
        return redirect()->back()->with('success','data is updated');
    }
}
