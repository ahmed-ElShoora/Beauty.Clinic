<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\Web\ContactUsService;
use App\Http\Requests\Web\ContcatRequest;

class ContactUsController extends Controller
{
    public function __construct(
        private ContactUsService $contactUsService
    ){}

    public function contcat(){
        $data = $this->contactUsService->get();
        return view('web.contact-us',compact('data'));
    }

    public function store(ContcatRequest $request){
        $result = $this->contactUsService->store($request->validated());
        if(!$result)
            return redirect()->back()->with('error','حدث خطأ غير متوقع');
        return redirect()->back()->with('success','تم إيصال استفسارك بنجاح ، انتظر مكالمتنا قريبا');
    }
}
