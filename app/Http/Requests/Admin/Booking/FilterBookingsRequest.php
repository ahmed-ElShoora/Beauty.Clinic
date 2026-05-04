<?php

namespace App\Http\Requests\Admin\Booking;

use Illuminate\Foundation\Http\FormRequest;

class FilterBookingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['nullable', 'string', 'in:all,pending,confirmed,cancelled'],
            'booking_date' => ['nullable', 'date_format:Y-m-d'],
            'search_name' => ['nullable', 'string', 'max:255'],
            'search_phone' => ['nullable', 'string', 'max:32'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'الحالة المختارة غير صحيحة',
            'booking_date.date_format' => 'صيغة التاريخ غير صحيحة',
            'search_name.max' => 'اسم المستخدم يجب ألا يتجاوز 255 حرف',
            'search_phone.max' => 'رقم الهاتف يجب ألا يتجاوز 32 حرف',
        ];
    }

    public function getFilters(): array
    {
        return [
            'status' => $this->input('status'),
            'booking_date' => $this->input('booking_date'),
            'search_name' => $this->input('search_name'),
            'search_phone' => $this->input('search_phone'),
        ];
    }
}
