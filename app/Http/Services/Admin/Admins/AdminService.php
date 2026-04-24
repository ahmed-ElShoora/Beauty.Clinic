<?php
namespace App\Http\Services\Admin\Admins;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAll(){
        return Admin::get();
    }
    public function delete($id){
        $admin = Admin::findOrFail($id);
        return $admin->delete();
    }
    public function create($request){
        $admin = Admin::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>Hash::make($request->password)
        ]);
        return $admin ? true : false;
    }
}