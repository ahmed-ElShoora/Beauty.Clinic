<?php

namespace App\Http\Services\Admin\Booking;

use App\Models\Booking;
use Carbon\Carbon;

class BookingService
{
    /**
     * Get bookings with filtering options
     */
    public function getFilteredBookings(array $filters = [])
    {
        $query = Booking::with('service');

        $cleanFilters = array_filter($filters, function ($value) {
            return $value !== null && $value !== '';
        });

        // Default filter: today's pending bookings when no filter is applied

        if (isset($cleanFilters['status']) && $cleanFilters['status'] !== 'all') {
            $query->where('status', $cleanFilters['status']);
        }

        if (isset($cleanFilters['booking_date'])) {
            $query->whereDate('booking_date', $cleanFilters['booking_date']);
        }else{
            $query->where('booking_date', today());
        }

        if (isset($cleanFilters['search_name'])) {
            $query->where('customer_name', 'LIKE', '%' . $cleanFilters['search_name'] . '%');
        }

        if (isset($cleanFilters['search_phone'])) {
            $query->where('customer_phone', 'LIKE', '%' . $cleanFilters['search_phone'] . '%');
        }

        return $query->get();
    }

    /**
     * Confirm attendance for a booking
     */
    public function confirmAttendance(int $bookingId): bool
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->status = Booking::STATUS_CONFIRMED;
        return $booking->save();
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking(int $bookingId): bool
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->status = Booking::STATUS_CANCELLED;
        return $booking->save();
    }

    /**
     * Get booking statistics for today or for a selected date
     */
    public function getTodayStats(array $filters = []): array
    {
        $cleanFilters = array_filter($filters, function ($value) {
            return $value !== null && $value !== '';
        });

        $date = $cleanFilters['booking_date'] ?? today()->format('Y-m-d');

        return [
            'all' => Booking::whereDate('booking_date', $date)
                                ->count(),
            'pending' => Booking::whereDate('booking_date', $date)
                                ->where('status', Booking::STATUS_PENDING)
                                ->count(),
            'confirmed' => Booking::whereDate('booking_date', $date)
                                  ->where('status', Booking::STATUS_CONFIRMED)
                                  ->count(),
            'cancelled' => Booking::whereDate('booking_date', $date)
                                  ->where('status', Booking::STATUS_CANCELLED)
                                  ->count(),
        ];
    }
}
