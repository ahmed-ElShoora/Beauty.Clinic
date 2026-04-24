<?php
 
namespace App\Http\Services\Admin\Auth;

class AuthAdminService
{
    public function login($data){
        $credentials = $data->only('email', 'password');
        if(auth()->guard('admin')->attempt($credentials)){
            return true;
        }
        return false;
    }

    public function logout(){
        auth()->guard('admin')->logout();
    }
}