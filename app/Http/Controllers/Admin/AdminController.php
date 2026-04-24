<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Services\Admin\Admins\AdminService;

class AdminController extends Controller
{
    public function __construct(
        private AdminService $adminService
    ){}

    public function index(){
        $admins = $this->adminService->getAll();
        return view('admin.admin.index',compact('admins'));
    }

    public function delete($id){
        $result = $this->adminService->delete($id);
        if(!$result){
            return back()->withErrors(['error' => 'Failed to delete admin. Please try again.']);
        }
        return redirect()->back()->with('success', 'Admin deleted successfully');
    }

    public function create(){
        return view('admin.admin.create');
    }

    public function store(CreateAdminRequest $request){
        $result = $this->adminService->create($request);
        if(!$result){
            return back()->withErrors(['error' => 'Failed to create admin. Please try again.']);
        }
        return redirect()->route('admin.admins')->with('success', 'Admin created successfully');
    }
}
