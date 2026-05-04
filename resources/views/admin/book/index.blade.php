@extends('layout.admin')

@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>قائمة الحجوزات</h1>
                    </div>

                    <div class="separator mb-5"></div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title">عدد الحجوزات</h5>
                            <h2 class="text-primary">{{ $stats['all'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title">قيد الانتظار</h5>
                            <h2 class="text-warning">{{ $stats['pending'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title">مؤكد</h5>
                            <h2 class="text-success">{{ $stats['confirmed'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title">ملغى</h5>
                            <h2 class="text-danger">{{ $stats['cancelled'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.booking') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">البحث بالاسم</label>
                                <input type="text" name="search_name" class="form-control" 
                                       placeholder="ابحث بالاسم" value="{{ $filters['search_name'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">البحث برقم الهاتف</label>
                                <input type="text" name="search_phone" class="form-control" 
                                       placeholder="ابحث برقم الهاتف" value="{{ $filters['search_phone'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">التاريخ</label>
                                <input type="date" name="booking_date" class="form-control" 
                                       value="{{ $filters['booking_date'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">الحالة</label>
                                <select name="status" class="form-control">
                                    <option value="all" {{ $filters['status'] === 'pending' ? 'all' : '' }}>كل الحالات</option>
                                    <option value="pending" {{ $filters['status'] === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="confirmed" {{ $filters['status'] === 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                                    <option value="cancelled" {{ $filters['status'] === 'cancelled' ? 'selected' : '' }}>ملغى</option>
                                </select>
                            </div>
                            <div class="col-md-12"style="
                                margin-top: 20px;
                                text-align: center;
                            ">
                                <button type="submit" class="btn btn-primary">بحث</button>
                                <a href="{{ route('admin.booking') }}" class="btn btn-secondary">إعادة تعيين</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>خطأ!</strong>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
            @endif

            <!-- Bookings Table -->
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card" style="overflow: auto">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">الاسم</th>
                                <th scope="col" class="text-center">رقم الهاتف</th>
                                <th scope="col" class="text-center">اسم الخدمة</th>
                                <th scope="col" class="text-center">سعر الخدمة</th>
                                <th scope="col" class="text-center">يوم الحجز</th>
                                <th scope="col" class="text-center">وقت الحجز</th>
                                <th scope="col" class="text-center">الحالة</th>
                                <th scope="col" class="text-center">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="text-center">{{$booking->customer_name}}</td>
                                    <td class="text-center">{{$booking->customer_phone}}</td>
                                    <td class="text-center">{{$booking->service->name}}</td>
                                    <td class="text-center">{{$booking->service->price}}</td>
                                    <td class="text-center">{{ formatArabicDate($booking->booking_date) }}</td>
                                    <td class="text-center">{{$booking->booking_time}}</td>
                                    <td class="text-center">
                                        @if($booking->status === 'pending')
                                            <span class="badge bg-warning">قيد الانتظار</span>
                                        @elseif($booking->status === 'confirmed')
                                            <span class="badge bg-success">مؤكد</span>
                                        @else
                                            <span class="badge bg-danger">ملغى</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($booking->status === 'pending')
                                            <form method="POST" action="{{ route('admin.booking.confirm', $booking->id) }}" 
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" 
                                                        onclick="return confirm('هل تريد تأكيد الحضور؟')">
                                                    تأكيد
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status !== 'cancelled')
                                            <form method="POST" action="{{ route('admin.booking.cancel', $booking->id) }}" 
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('هل تريد إلغاء الحجز؟')">
                                                    إلغاء
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        لا توجد حجوزات
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- <div style="margin:auto;">
                            {{$bookings->links()}}
                        </div> --}}

                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
