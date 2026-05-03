<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', Rule::exists('services', 'id')],
            'booking_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'booking_time' => ['required', 'string', 'max:64'],
            'customer_name' => ['required', 'string', 'min:2', 'max:190'],
            'customer_phone' => ['required', 'string', 'max:32', $this->saudiMobileRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'يجب اختيار الخدمة.',
            'service_id.exists' => 'الخدمة غير موجودة.',
            'booking_date.required' => 'يجب تحديد اليوم.',
            'booking_date.after_or_equal' => 'لا يمكن الحجز في تاريخ ماضٍ.',
            'booking_time.required' => 'يجب تحديد وقت الموعد.',
            'customer_name.required' => 'يرجى إدخال الاسم.',
            'customer_phone.required' => 'يرجى إدخال رقم الجوال.',
        ];
    }

    /**
     * @return \Closure(string, mixed, \Closure(string): void): void
     */
    private function saudiMobileRule(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail): void {
            $digits = preg_replace('/\D/', '', (string) $value);
            if (str_starts_with($digits, '966')) {
                $digits = substr($digits, 3);
            }
            if (str_starts_with($digits, '0')) {
                $digits = substr($digits, 1);
            }
            if (! preg_match('/^5[0-9]{8}$/', $digits)) {
                $fail('رقم الجوال السعودي غير صالح.');
            }
        };
    }

    protected function prepareForValidation(): void
    {
        $phone = $this->input('customer_phone');
        if ($phone !== null && is_string($phone)) {
            $digits = preg_replace('/\D/', '', $phone);
            if (str_starts_with($digits, '966')) {
                $digits = substr($digits, 3);
            }
            if (str_starts_with($digits, '0')) {
                $digits = substr($digits, 1);
            }
            if (preg_match('/^5[0-9]{8}$/', $digits)) {
                $this->merge([
                    'customer_phone' => '0'.$digits,
                ]);
            }
        }
    }
}
