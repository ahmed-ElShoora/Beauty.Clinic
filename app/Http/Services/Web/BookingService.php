<?php

namespace App\Http\Services\Web;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookingService
{
    /**
     * @return array{services: Collection, schedules: Collection}
     */
    public function getIndexViewData()
    {
        $services = Service::query()->orderBy('id')->get()->map(function (Service $service) {
            $service->icon_url = asset('storage/'.$service->icon);

            return $service;
        });

        $schedules = Schedule::with('slots')
            ->orderBy('day_of_week')
            ->get()
            ->mapWithKeys(function (Schedule $schedule) {
                return [
                    $schedule->day_of_week => [
                        'is_closed' => (bool) $schedule->is_closed,
                        'slots' => $schedule->slots->map(function ($slot) {
                            return [
                                'start_time' => Carbon::parse($slot->start_time)->format('H:i'),
                                'end_time' => Carbon::parse($slot->end_time)->format('H:i'),
                            ];
                        })->values()->all(),
                    ],
                ];
            });
        return compact('services', 'schedules');
    }

    public function store(array $data): ?Booking
    {
        return Booking::create([
            'service_id' => $data['service_id'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'status' => Booking::STATUS_PENDING,
        ]);
    }
}
