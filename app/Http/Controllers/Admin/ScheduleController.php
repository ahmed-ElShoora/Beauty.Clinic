<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Schedule\ScheduleService;

class ScheduleController extends Controller
{
    public function __construct(
        private ScheduleService $scheduleService
    ){}

    public function index()
    {
        $this->scheduleService->initIfEmpty();
        $schedules = $this->scheduleService->get();

        return view('admin.schedule.index', compact('schedules'));
    }

    public function update(Request $request)
    {
        $result = $this->scheduleService->update($request->days);
        if(!$result){
            return redirect()->back()->withErrors(['error'=>'data not updated']);
        }
        return redirect()->back()->with('success','data is updated');    
    }
}
