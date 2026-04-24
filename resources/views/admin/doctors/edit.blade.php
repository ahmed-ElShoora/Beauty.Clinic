@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">تعديل طبيب موجود</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{Route('admin.doctors.update', $doctor->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الاسم ***</label>
                                    <input name="name" required="" value="{{ old('name', $doctor->name) }}" id="Name" type="text" class="form-control">
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
                                <input name="specialization" value="{{ old('name', $doctor->specialization) }}" id="specialization" type="text" class="form-control">
                                @error('specialization')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">specialization</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>الخبرة</label>
                                <input name="experience" value="{{ old('name', $doctor->experience) }}" id="experience" type="text" class="form-control">
                                @error('experience')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">experience</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>وصف</label>
                                <input name="description" value="{{ old('name', $doctor->description) }}" id="description" type="text" class="form-control">
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
