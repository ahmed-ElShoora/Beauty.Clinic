<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BookStoreRequest;
use App\Http\Services\Web\BookingService;

class BookController extends Controller
{
    public function __construct(
        private BookingService $bookingService
    ) {}

    public function index()
    {
        return view('web.book', $this->bookingService->getIndexViewData());
    }

    public function store(BookStoreRequest $request)
    {
        $booking = $this->bookingService->store($request->validated());

        if (! $booking) {
            return response()->json([
                'message' => 'تعذر حفظ الحجز، حاول مرة أخرى.',
            ], 500);
        }

        return response()->json([
            'message' => 'تم حجز الموعد بنجاح',
            'booking_id' => $booking->id,
        ]);
    }
}
