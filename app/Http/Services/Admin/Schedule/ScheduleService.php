<?php 

namespace App\Http\Services\Admin\Schedule;

use App\Models\Schedule;

class ScheduleService{

    public function initIfEmpty(): void {
        if (Schedule::count() == 0) {
            for ($i = 0; $i < 7; $i++) {
                Schedule::create([
                    'day_of_week' => $i,
                    'is_closed' => false
                ]);
            }
        }
    }

    public function get(){
        return Schedule::with('slots')
            ->get()
            ->keyBy('day_of_week');
    }

    public function update($days): bool
    {
        foreach ($days as $dayIndex => $dayData) {

            $slots = $dayData['slots'] ?? [];

            if (!isset($dayData['is_closed']) && $this->hasOverlap($slots)) {
                return false;
            }

            $schedule = Schedule::updateOrCreate(
                ['day_of_week' => $dayIndex],
                ['is_closed' => isset($dayData['is_closed'])]
            );

            // حذف القديم
            $schedule->slots()->delete();

            // إضافة الجديد
            if (!isset($dayData['is_closed'])) {
                foreach ($slots as $slot) {

                    if (!empty($slot['start']) && !empty($slot['end'])) {

                        $schedule->slots()->create([
                            'start_time' => $slot['start'],
                            'end_time' => $slot['end'],
                        ]);
                    }
                }
            }
        }

        return true;
    }

    private function hasOverlap($slots): bool
    {
        if (count($slots) <= 1) return false;

        usort($slots, fn($a, $b) => strcmp($a['start'], $b['start']));

        for ($i = 1; $i < count($slots); $i++) {
            if ($slots[$i]['start'] < $slots[$i - 1]['end']) {
                return true;
            }
        }

        return false;
    }
}