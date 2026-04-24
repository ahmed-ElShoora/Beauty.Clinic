@extends('layout.admin')

@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>قائمة الأطباء</h1>
                        <div class="top-right-button-container">
                                    <a href="{{Route('admin.doctors.create')}}" class="btn btn-primary btn-lg top-right-button mr-1">انشاء طبيب</a>
                        </div>
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
                                <th scope="col" class="text-center">الاختصاص</th>
                                <th scope="col" class="text-center">الخبرة</th>
                                <th scope="col" class="text-center">الوصف</th>
                                <th scope="col" class="text-center">تعديل</th>
                                <th scope="col" class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td class="text-center">{{$doctor->name}}</td>
                                    <td class="text-center">{{$doctor->specialization}}</td>
                                    <td class="text-center">{{$doctor->experience}}</td>
                                    <td class="text-center">{{$doctor->description}}</td>
                                    <td class="text-center">
                                        <a href="{{Route('admin.doctors.edit',$doctor->id)}}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{Route('admin.doctors.delete',$doctor->id)}}" class="btn btn-sm btn-outline-danger">حذف</a>
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
