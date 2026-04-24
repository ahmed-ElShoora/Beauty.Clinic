@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">انشاء طبيب جديد</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{Route('admin.doctors.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الاسم ***</label>
                                    <input name="name" required="" id="Name" type="text" class="form-control">
                                    @error('name')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">Name</div>
                                </div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>التخصص</label>
                                <input name="specialization" id="specialization" type="text" class="form-control">
                                @error('specialization')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">specialization</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>الخبرة</label>
                                <input name="experience" id="experience" type="text" class="form-control">
                                @error('experience')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">experience</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>وصف</label>
                                <input name="description" id="description" type="text" class="form-control">
                                @error('description')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">description</div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>صورة</label>
                                    <input name="photo" id="photo" type="file" accept="image/*" class="form-control">
                                    @error('icon')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">photo</div>
                                </div>
                            </div>
                            

                            <button class="btn btn-primary mt-5" type="submit">تاكيد</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
