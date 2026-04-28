@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">الإعدادات</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{Route('admin.setting.update')}}">
                            @csrf
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>رقم الهاتف ***</label>
                                    <input name="phone" value="{{ $data['phone'] }}" required="" id="phone" type="text" class="form-control">
                                    @error('phone')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">phone</div>
                                </div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>رقم الواتساب (بالكود الدولي دون علامة +) ***</label>
                                    <input name="whatsapp" value="{{ $data['whatsapp'] }}" required="" id="whatsapp" type="text" class="form-control">
                                    @error('whatsapp')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">whatsapp</div>
                                </div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الايميل ***</label>
                                    <input name="email" value="{{ $data['email'] }}" required="" id="email" type="email" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">email</div>
                                </div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>رابط الخريطه ***</label>
                                    <input name="map" value="{{ $data['map'] }}" required="" id="map" type="url" class="form-control">
                                    @error('map')
                                    <div class="alert alert-danger" role="alert" style="text-align: center">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="invalid-tooltip">map</div>
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
