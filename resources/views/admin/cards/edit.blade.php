@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">تعديل بطاقة موجودة</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{Route('admin.cards.update', $card->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الاسم ***</label>
                                    <input name="name" required="" value="{{ old('name', $card->name) }}" id="Name" type="text" class="form-control">
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
                                <input name="description" required="" value="{{ old('description', $card->description) }}" id="description" type="text" class="form-control">
                                @error('description')
                                <div class="alert alert-danger" role="alert" style="text-align: center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-tooltip">Description</div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الايقونة</label>
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
