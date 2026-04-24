<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Services\Admin\Auth\AuthAdminService;

class AuthController extends Controller
{
    public function __construct(
        private AuthAdminService $authAdminService
    ){}
    public function login(){
        return view('admin.auth.login');
    }

    public function authenticate(AdminLoginRequest $request){
        $status = $this->authAdminService->login($request);

        if ($status) {
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(){
        $this->authAdminService->logout();
        return redirect()->route('login');
    }
}
