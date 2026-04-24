@extends('layout.admin')

@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>قائمة الاتصالات</h1>
                    </div>

                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card" style="overflow: auto">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">الاسم</th>
                                <th scope="col" class="text-center">الهاتف</th>
                                <th scope="col" class="text-center" colspan="2">الرسالة</th>
                                <th scope="col" class="text-center">إخفاء</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="text-center">{{$contact->name}}</td>
                                    <td class="text-center">{{$contact->phone}}</td>
                                    <td class="text-center" colspan="2">{{$contact->message}}</td>
                                    <td class="text-center">
                                        <a href="{{Route('admin.contacts.hide',$contact->id)}}" class="btn btn-sm btn-outline-danger">إخفاء</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </main>
@endsection
