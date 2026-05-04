<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Booking\FilterBookingsRequest;
use App\Http\Services\Admin\Booking\BookingService;
use App\Models\Booking;

class BookingController extends Controller
{
    

    public function __construct(
        private BookingService $bookingService
    ){}

    public function index(FilterBookingsRequest $request)
    {
        $filters = $request->getFilters();

        // Check if any filter is applied
        $hasFilters = collect($filters)->filter(function ($value) {
            return !empty($value);
        })->isNotEmpty();

        // Get filtered bookings
        $bookings = $this->bookingService->getFilteredBookings(
            $hasFilters ? $filters : []
        );

        // Get statistics for selected date or today
        $stats = $this->bookingService->getTodayStats(
            $hasFilters ? $filters : []
        );

        return view('admin.book.index', compact('bookings', 'stats', 'filters'));
    }

    public function confirmAttendance($id)
    {
        try {
            $this->bookingService->confirmAttendance($id);
            return redirect()->back()->with('success', 'تم تأكيد الحضور بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تأكيد الحضور');
        }
    }

    public function cancel($id)
    {
        try {
            $this->bookingService->cancelBooking($id);
            return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إلغاء الحجز');
        }
    }
}
