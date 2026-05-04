<?php

use Carbon\Carbon;

if (!function_exists('formatArabicDate')) {
    function formatArabicDate($date)
    {
        return Carbon::parse($date)
            ->locale('ar')
            ->translatedFormat('j F Y');
    }
}