@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">تعديل بطاقة موجودة</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{Route('admin.services.update', $service->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الاسم ***</label>
                                    <input name="name" required="" id="Name" type="text" class="form-control" value="{{ old('name', $service->name) }}">
                                    @error('name')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">Name</div>
                                </div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>الوصف ***</label>
                                <input name="description" required="" id="description" type="text" class="form-control" value="{{ old('description', $service->description) }}">
                                @error('description')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">Description</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>مدة التنفيذ بالدقائق</label>
                                <input name="duration" id="duration" value="{{ old('duration', $service->duration) }}" type="number" class="form-control">
                                @error('duration')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">Duration</div>
                            </div>

                            <div class="tooltip-center-top position-relative form-group">
                                <label>السعر</label>
                                <input name="price" id="price" value="{{ old('price', $service->price) }}" type="number" class="form-control">
                                @error('price')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">Price</div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>باتش ***</label>
                                    <input name="patch" value="{{ old('patch', $service->patch) }}" id="Patch" type="text" class="form-control">
                                    @error('patch')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">Patch</div>
                                </div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الايقونة ***</label>
                                    <input name="icon" id="icon" type="file" accept="image/*" class="form-control">
                                    @error('icon')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">Icon</div>
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
