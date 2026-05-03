@extends('layout.web')

@section('style')
    <style>
    .page-hero {
        padding: 46px 0 28px;
        background: var(--c-surface);
        border-bottom: 1px solid rgba(232, 239, 243, .9);
    }

    .page-hero h1 {
        margin: 0 0 8px;
        font-weight: 800;
        font-size: 32px;
        color: var(--c-text);
        text-align: center;
    }

    .page-hero p {
        margin: 0 auto;
        max-width: 720px;
        color: var(--c-muted);
        font-size: 13px;
        text-align: center;
        line-height: 1.85;
    }
    /* الكارت الداخلي بعرض الكونتينر؛ المحاذاة أفقيًا زي الهيدر والهيرو */
    .booking-section {
        background: white;
        padding: 40px 0;
        border-radius: 12px;
        margin-bottom: 40px;
        width: 100%;
        box-sizing: border-box;
    }
    .step-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 8px;
    }
    .step-title {
        font-size: 1rem;
        color: var(--c-primary);
        font-weight: 600;
    }
    .step-number {
        background: var(--c-primary);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    /* موبايل: عمود واحد. سطح المكتب (901px+): عمودان — الملخص يمين (sticky)، الخطوات يسار */
    .main-content {
        display: flex;
        flex-direction: column;
        gap: 28px;
        width: 100%;
        margin: 0 auto;
        align-items: stretch;
    }
    @media (min-width: 901px) {
        .main-content.main-content--with-sidebar {
            display: grid;
            grid-template-columns: minmax(280px, 340px) minmax(0, 1fr);
            gap: 32px;
            align-items: start;
        }
        .main-content.main-content--with-sidebar .booking-details {
            grid-column: 1;
            grid-row: 1;
            position: sticky;
            top: 88px;
            max-height: calc(100vh - 100px);
            overflow: auto;
        }
        .main-content.main-content--with-sidebar .booking-main-col {
            grid-column: 2;
            grid-row: 1;
            min-width: 0;
        }
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr));
        gap: clamp(14px, 2vw, 20px);
        width: 100%;
        min-width: 0;
    }
    .service-grid-card {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        justify-content: flex-end;
        background: #fff;
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 18px 22px;
        cursor: pointer;
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease, transform .2s ease;
        text-align: right;
        min-height: auto;
        position: relative;
        gap: 16px;
        direction: rtl;
        box-shadow: 0 1px 2px rgba(15, 36, 48, .04);
    }
    .service-grid-card:hover {
        border-color: rgba(45, 111, 134, .28);
        background: var(--c-surface);
        box-shadow: 0 4px 14px rgba(15, 36, 48, .06);
    }
    .service-grid-card.selected {
        border-color: var(--c-primary);
        background: linear-gradient(145deg, rgba(45, 111, 134, .07) 0%, rgba(45, 111, 134, .03) 100%);
        box-shadow:
            0 0 0 1px rgba(45, 111, 134, .12),
            0 8px 22px rgba(45, 111, 134, .14);
    }
    .service-grid-card.selected .service-grid-name {
        color: var(--c-primary);
    }
    .service-grid-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(145deg, rgba(45, 111, 134, .14), rgba(45, 111, 134, .06));
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(45, 111, 134, .12);
        overflow: hidden;
        margin-bottom: 0;
        flex-shrink: 0;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .service-grid-card.selected .service-grid-icon {
        border-color: rgba(45, 111, 134, .35);
        box-shadow: 0 2px 10px rgba(45, 111, 134, .18);
    }
    .service-grid-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .service-grid-name {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .service-grid-desc {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.3;
    }
    .service-info-wrapper {
        text-align: right;
        flex: 1;
    }
    .service-preview {
        display: none !important;
    }
    .service-preview.hidden {
        display: none !important;
    }
    .service-preview-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        border: 4px solid var(--c-primary);
        overflow: hidden;
    }
    .service-preview-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .service-preview-name {
        font-size: 1.25rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 8px;
    }
    .service-preview-desc {
        font-size: 0.95rem;
        color: #6b7280;
        line-height: 1.5;
    }
    .booking-summary {
        background: white;
        /* border: 2px solid var(--c-primary); */
        border-radius: 16px;
        padding: 32px 28px;
        width: 100%;
        max-width: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.20);
        display: none;
    }
    .booking-summary.show {
        display: block;
    }
    .summary-title {
        font-size: 1rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 20px;
        text-align: right;
    }
    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 14px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--c-primary);
        text-align: right;
        direction: rtl;
    }
    .summary-item--flush {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .summary-label {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.85rem;
    }
    .summary-value {
        color: #6b7280;
        font-size: 0.80rem;
    }
    .confirm-button {
        width: 100%;
        background: var(--c-primary);
        color: white;
        border: none;
        padding: 14px 20px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .confirm-button:hover:not(:disabled) {
        background: #7bb3c0;
    }
    .confirm-button:disabled {
        opacity: .45;
        cursor: not-allowed;
        filter: grayscale(.25);
    }
    .confirm-button-text {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .booking-main-col {
        min-width: 0;
        width: 100%;
    }
    .booking-main-col.is-hidden {
        display: none !important;
    }
    .wizard-panel.is-hidden {
        display: none !important;
    }
    .wizard-back-row {
        margin: 0 0 14px;
        text-align: right;
        direction: rtl;
    }
    .wizard-back-link {
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--c-primary);
        cursor: pointer;
        text-decoration: underline;
        text-underline-offset: 3px;
    }
    .wizard-back-link:hover {
        color: var(--c-primary-2, #3f7f96);
    }
    .booking-summary .summary-edit-row {
        margin: -8px 0 16px;
        text-align: right;
        direction: rtl;
    }
    .summary-edit-row {
        display: none;
    }
    .booking-summary.booking-summary--contact .summary-edit-row {
        display: block;
    }
    .summary-pending-hint {
        display: none;
        margin: 0 0 16px;
        font-size: 0.82rem;
        color: var(--c-muted);
        text-align: right;
        direction: rtl;
        line-height: 1.55;
    }
    .booking-summary.show:not(.booking-summary--contact) .summary-pending-hint {
        display: block;
    }
    .booking-contact-wrap {
        display: none;
    }
    .booking-summary.booking-summary--contact .booking-contact-wrap {
        display: block;
    }
    .wizard-desktop-aside {
        display: none !important;
        padding: 20px;
        border-radius: var(--radius);
        border: 1px dashed rgba(45, 111, 134, .35);
        background: linear-gradient(145deg, rgba(45, 111, 134, .06), rgba(45, 111, 134, .02));
        margin-top: 8px;
    }
    @media (min-width: 901px) {
        .wizard-desktop-aside:not(.is-hidden) {
            display: block !important;
        }
    }
    .booking-flow-block {
        margin-top: 0;
        padding-top: 0;
        border-top: none;
    }
    .step-header--compact {
        margin-bottom: 16px;
    }
    .booking-flow-subtitle {
        margin: 0 0 14px;
        font-size: 0.82rem;
        color: var(--c-muted);
        text-align: right;
        direction: rtl;
        line-height: 1.6;
    }
    .date-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        direction: rtl;
        justify-content: flex-start;
    }
    .date-chip {
        padding: 11px 16px;
        border-radius: var(--radius);
        border: 1px solid var(--c-border);
        background: #fff;
        cursor: pointer;
        font-family: inherit;
        font-size: 0.88rem;
        color: var(--c-text);
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        text-align: center;
        line-height: 1.35;
        min-width: 118px;
    }
    .date-chip:hover {
        border-color: rgba(45, 111, 134, .35);
        background: var(--c-surface);
    }
    .date-chip.selected {
        border-color: var(--c-primary);
        background: linear-gradient(145deg, rgba(45, 111, 134, .07), rgba(45, 111, 134, .03));
        box-shadow: 0 2px 10px rgba(45, 111, 134, .12);
        font-weight: 600;
        color: var(--c-primary);
    }
    .date-chip.date-chip--closed {
        opacity: .55;
        cursor: not-allowed;
        background: #f3f4f6;
        border-style: dashed;
        color: var(--c-muted);
    }
    .date-chip.date-chip--closed:hover {
        border-color: var(--c-border);
        background: #f3f4f6;
        box-shadow: none;
    }
    .booking-empty-times {
        margin: 0;
        padding: 14px 16px;
        border-radius: var(--radius);
        background: var(--c-surface);
        border: 1px dashed var(--c-border);
        color: var(--c-muted);
        font-size: 0.88rem;
        text-align: right;
        direction: rtl;
        line-height: 1.55;
    }
    .time-slots-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(100%, 92px), 1fr));
        gap: 10px;
        direction: rtl;
    }
    .time-slot {
        padding: 11px 8px;
        border-radius: 10px;
        border: 1px solid var(--c-border);
        background: #fff;
        cursor: pointer;
        font-family: inherit;
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--c-text);
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        text-align: center;
    }
    .time-slot:hover:not(:disabled) {
        border-color: rgba(45, 111, 134, .35);
        background: var(--c-surface);
    }
    .time-slot.selected {
        border-color: var(--c-primary);
        background: linear-gradient(145deg, rgba(45, 111, 134, .09), rgba(45, 111, 134, .04));
        color: var(--c-primary);
        box-shadow: 0 2px 10px rgba(45, 111, 134, .12);
    }
    .time-slot:disabled {
        opacity: .38;
        cursor: not-allowed;
    }
    .booking-contact-fields {
        margin-top: 22px;
        padding-top: 22px;
        border-top: 1px solid var(--c-border);
        text-align: right;
        direction: rtl;
    }
    .booking-field-label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--c-text);
        margin-bottom: 8px;
    }
    .booking-field-input {
        width: 100%;
        padding: 11px 14px;
        margin-bottom: 14px;
        border-radius: 10px;
        border: 1px solid var(--c-border);
        font-family: inherit;
        font-size: 0.92rem;
        color: var(--c-text);
        background: #fff;
        transition: border-color .2s ease, box-shadow .2s ease;
        box-sizing: border-box;
    }
    .booking-field-input:last-of-type {
        margin-bottom: 0;
    }
    .booking-field-input::placeholder {
        color: #9ca3af;
    }
    .booking-field-input:focus {
        outline: none;
        border-color: rgba(45, 111, 134, .55);
        box-shadow: 0 0 0 3px rgba(45, 111, 134, .12);
    }
    .booking-hint {
        font-size: 0.82rem;
        color: var(--c-muted);
        text-align: center;
        margin-top: 10px;
        line-height: 1.55;
    }
    .booking-feedback {
        display: none;
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: var(--radius);
        font-size: 0.88rem;
        text-align: right;
        direction: rtl;
        line-height: 1.5;
    }
    .booking-feedback.is-visible {
        display: block;
    }
    .booking-feedback--success {
        background: rgba(45, 111, 134, .1);
        border: 1px solid rgba(45, 111, 134, .35);
        color: var(--c-primary);
        font-weight: 600;
    }
    .booking-feedback--error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
    .confirm-button.is-busy {
        pointer-events: none;
        opacity: .85;
    }
    @media (max-width: 900px) {
        .booking-summary {
            max-width: 100%;
        }
    }
    @media (max-width: 600px) {
        .services-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .service-grid-card {
            min-height: auto;
            padding: 16px 18px;
        }
        .service-grid-icon {
            width: 60px;
            height: 60px;
        }
        .service-grid-name {
            font-size: 0.95rem;
        }
        .service-grid-desc {
            font-size: 0.8rem;
        }
        .booking-title {
            font-size: 1.5rem;
        }
        .booking-summary {
            max-width: 100%;
        }
    }
    .hidden {
        display: none !important;
    }
    </style>
@endsection

@section('content')
    <section class="page-hero">
        <div class="web-container">
            <h1>احجز موعدك</h1>
            <p>
            خطوات بسيطة للحصول على الرعاية التي تستحقها في عيادة درما بيوتي.
            </p>
        </div>
    </section>
    <div class="web-container">
        <div class="booking-section">
            <div class="main-content">
                <div class="booking-main-col">
                    <div id="wizard-step-service" class="wizard-panel">
                        <div class="step-header">
                            <span class="step-number">1</span>
                            <span class="step-title">اختيار الخدمة</span>
                        </div>

                        <div class="services-grid" id="services-grid-container">
                            @foreach($services as $service)
                                <div class="service-grid-card" onclick="selectService({{ $service['id'] }})" id="service-{{ $service['id'] }}">
                                    <div class="service-grid-icon">
                                        <img src="{{ $service['icon_url'] }}" alt="{{ $service['name'] }}">
                                    </div>
                                    <div class="service-info-wrapper">
                                        <div class="service-grid-name">{{ $service['name'] }}</div>
                                        <div class="service-grid-desc">{{ $service['description'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="booking-step-date" class="wizard-panel booking-flow-block is-hidden">
                        <div class="wizard-back-row">
                            <button type="button" class="wizard-back-link" id="wizard-back-to-service">← تغيير الخدمة</button>
                        </div>
                        <div class="step-header step-header--compact">
                            <span class="step-number">2</span>
                            <span class="step-title">اختيار اليوم</span>
                        </div>
                        <p class="booking-flow-subtitle">الأيام التي عليها «مغلق» وفق جدول العيادة لا يمكن حجزها. المتاح فقط أيام دوام حقيقية مع فترات عمل.</p>
                        <div id="date-chips-container" class="date-chips" role="group" aria-label="اختيار اليوم"></div>
                    </div>

                    <div id="booking-step-time" class="wizard-panel booking-flow-block is-hidden">
                        <div class="wizard-back-row">
                            <button type="button" class="wizard-back-link" id="wizard-back-to-date">← تغيير اليوم</button>
                        </div>
                        <div class="step-header step-header--compact">
                            <span class="step-number">3</span>
                            <span class="step-title">اختيار الوقت</span>
                        </div>
                        <p class="booking-flow-subtitle">اختر وقت الموعد (كل مربع نصف ساعة ضمن أوقات عمل العيادة لهذا اليوم).</p>
                        <div id="time-slots-container" class="time-slots-grid" role="group" aria-label="اختيار الوقت"></div>
                    </div>

                    <div id="wizard-step-desktop-aside" class="wizard-desktop-aside wizard-panel is-hidden" aria-hidden="true">
                        <div class="step-header step-header--compact">
                            <span class="step-number">✓</span>
                            <span class="step-title">تم اختيار الموعد</span>
                        </div>
                        <p class="booking-flow-subtitle" style="margin-bottom:12px;">أكمل بياناتك في بطاقة الملخص ثم أكّد الحجز.</p>
                        <button type="button" class="wizard-back-link" id="wizard-back-to-time-desktop">تعديل اليوم أو الوقت</button>
                    </div>
                </div>

                <div class="booking-summary" id="booking-details">
                    <div class="summary-title">ملخص الحجز</div>
                    <p class="summary-pending-hint" id="summary-pending-hint">اختر اليوم ثم الوقت من خطوات الحجز لعرض حقول الاسم والجوال والتأكيد.</p>
                    <div class="summary-edit-row">
                        <button type="button" class="wizard-back-link" id="wizard-back-to-time">تعديل اليوم أو الوقت</button>
                    </div>
                    <div id="booking-service-block"></div>
                    <div class="summary-item">
                        <span class="summary-label">اليوم</span>
                        <span class="summary-value" id="sum-date">لم يتم الاختيار</span>
                    </div>
                    <div class="summary-item summary-item--flush">
                        <span class="summary-label">الساعة</span>
                        <span class="summary-value" id="sum-time">لم يتم الاختيار</span>
                    </div>
                    <div class="booking-contact-wrap" id="booking-contact-wrap">
                        <div class="booking-feedback" id="booking-feedback" role="status" aria-live="polite"></div>
                        <div class="booking-contact-fields">
                            <label class="booking-field-label" for="booking-customer-name">الاسم الكامل</label>
                            <input class="booking-field-input" id="booking-customer-name" type="text" autocomplete="name" placeholder="اكتب اسمك كما سيُستخدم في الموعد">

                            <label class="booking-field-label" for="booking-customer-phone">رقم الجوال السعودي</label>
                            <input class="booking-field-input" id="booking-customer-phone" type="tel" inputmode="numeric" autocomplete="tel" placeholder="05xxxxxxxx (10 أرقام)">
                        </div>
                        <button type="button" class="confirm-button" id="confirm-booking-btn" disabled>
                            <span class="confirm-button-text">
                                <span>✓</span>
                                <span>تأكيد الحجز</span>
                            </span>
                        </button>
                        <div class="booking-hint">أدخل اسمك ورقم جوال سعودي صالح (يبدأ بـ 05) ثم أكّد الحجز.</div>
                    </div>
                </div>
            </div>
            <div class="confirmed hidden">
                <div id="wizard-step-desktop-aside" class="wizard-desktop-aside wizard-panel" aria-hidden="false">
                    <div class="step-header step-header--compact">
                        <span class="step-number">✓</span>
                        <span class="step-title">تم حجز الموعد بنجاح</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const BOOKING_STORE_URL = @json(url('/book-appointment'));
        const CSRF_TOKEN = @json(csrf_token());

        const services = @json($services);
        /** مفتاح يوم الأسبوع كما في JS Date#getDay(): 0 أحد … 6 سبت — مطابق لجدول schedules */
        const schedulesByDay = @json($schedules);

        const BOOKING_CONFIG = {
            daysAhead: 14,
            slotMinutes: 30,
            todayBufferMinutes: 0,
        };

        const bookingState = {
            serviceId: null,
            dateISO: null,
            timeLabel: null,
        };

        const mqBookingWide = window.matchMedia('(min-width: 901px)');
        function isBookingWideViewport() {
            return mqBookingWide.matches;
        }

        const escapeHtml = (s) => {
            const d = document.createElement('div');
            d.textContent = s == null ? '' : String(s);
            return d.innerHTML;
        };

        function localISODate(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${day}`;
        }

        function formatDateSummary(iso) {
            const [yy, mm, dd] = iso.split('-').map(Number);
            const d = new Date(yy, mm - 1, dd);
            return new Intl.DateTimeFormat('ar-SA-u-ca-gregory', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            }).format(d);
        }

        function formatDateChip(iso) {
            const [yy, mm, dd] = iso.split('-').map(Number);
            const d = new Date(yy, mm - 1, dd);
            const line1 = new Intl.DateTimeFormat('ar-SA-u-ca-gregory', {
                weekday: 'short',
            }).format(d);
            const line2 = new Intl.DateTimeFormat('ar-SA-u-ca-gregory', {
                day: 'numeric',
                month: 'short',
            }).format(d);
            return `${line1}\n${line2}`;
        }

        /** عرض الوقت بصيغة 12 ساعة مع ص/م وأرقام عربية (مثلاً ٩:٠٠ ص) — بدل ١٣:٠٠ */
        function minutesToClockLabel(mins) {
            const h24 = Math.floor(mins / 60);
            const m = mins % 60;
            const d = new Date(2000, 0, 1, h24, m, 0);
            return new Intl.DateTimeFormat('ar-SA-u-ca-gregory', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true,
            }).format(d);
        }

        function scheduleForJsWeekday(dayIndex) {
            const s = schedulesByDay?.[dayIndex] ?? schedulesByDay?.[String(dayIndex)];
            return s && typeof s === 'object' ? s : null;
        }

        function isDayBookable(dayIndex) {
            const sch = scheduleForJsWeekday(dayIndex);
            if (!sch || sch.is_closed) return false;
            const slots = sch.slots;
            return Array.isArray(slots) && slots.length > 0;
        }

        /** دقائق من منتصف الليل من "HH:mm" أو "HH:mm:ss" */
        function parseTimeToMinutes(str) {
            const p = String(str || '').trim().split(':');
            const h = parseInt(p[0], 10) || 0;
            const m = parseInt(p[1], 10) || 0;
            return h * 60 + m;
        }

        /** بدايات مواعيد كل نصف ساعة داخل [start, end) لكل فترة في الجدول */
        function collectSlotStartMinutes(slots, stepMinutes) {
            const starts = new Set();
            for (const sl of slots) {
                const sm = parseTimeToMinutes(sl.start_time);
                const em = parseTimeToMinutes(sl.end_time);
                if (em <= sm) continue;
                let t = Math.ceil(sm / stepMinutes) * stepMinutes;
                if (t < sm) t += stepMinutes;
                for (; t < em; t += stepMinutes) {
                    starts.add(t);
                }
            }
            return [...starts].sort((a, b) => a - b);
        }

        function renderServiceBlock(service) {
            const block = document.getElementById('booking-service-block');
            let html = `
                <div class="summary-item">
                    <span class="summary-label">الخدمة</span>
                    <span class="summary-value">${escapeHtml(service.name)}</span>
                </div>`;
            if (service.price) {
                html += `
                <div class="summary-item">
                    <span class="summary-label">السعر</span>
                    <span class="summary-value">${escapeHtml(service.price)}</span>
                </div>`;
            }
            if (service.duration) {
                html += `
                <div class="summary-item">
                    <span class="summary-label">وقت التنفيذ</span>
                    <span class="summary-value">${escapeHtml(service.duration)} دقيقة</span>
                </div>`;
            }
            block.innerHTML = html;
        }

        function renderDateChips() {
            const wrap = document.getElementById('date-chips-container');
            wrap.innerHTML = '';
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            for (let i = 0; i < BOOKING_CONFIG.daysAhead; i++) {
                const d = new Date(today);
                d.setDate(d.getDate() + i);
                const iso = localISODate(d);
                const dayIdx = d.getDay();
                const bookable = isDayBookable(dayIdx);

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.disabled = !bookable;
                btn.className =
                    'date-chip' +
                    (bookingState.dateISO === iso ? ' selected' : '') +
                    (!bookable ? ' date-chip--closed' : '');
                btn.dataset.iso = iso;
                btn.style.whiteSpace = 'pre-line';
                btn.textContent = formatDateChip(iso) + (!bookable ? '\n(مغلق)' : '');
                btn.title = !bookable ? 'لا توجد مواعيد في هذا اليوم' : '';
                if (bookable) {
                    btn.addEventListener('click', () => selectDate(iso));
                }
                wrap.appendChild(btn);
            }
        }

        function renderTimeSlots() {
            const wrap = document.getElementById('time-slots-container');
            wrap.innerHTML = '';
            if (!bookingState.dateISO) return;
            
            console.log(bookingState);
            

            const [yy, mm, dd] = bookingState.dateISO.split('-').map(Number);
            const chosen = new Date(yy, mm - 1, dd);
            const dayIdx = chosen.getDay();
            const sch = scheduleForJsWeekday(dayIdx);

            if (!sch || sch.is_closed || !Array.isArray(sch.slots) || sch.slots.length === 0) {
                const p = document.createElement('p');
                p.className = 'booking-empty-times';
                p.textContent = 'لا توجد أوقات عمل لهذا اليوم. اختر يومًا آخر.';
                wrap.appendChild(p);
                return;
            }

            const startMinutesList = collectSlotStartMinutes(sch.slots, BOOKING_CONFIG.slotMinutes);
            if (startMinutesList.length === 0) {
                const p = document.createElement('p');
                p.className = 'booking-empty-times';
                p.textContent = 'لم تُعرّف فترات زمنية كافية لهذا اليوم في جدول العيادة.';
                wrap.appendChild(p);
                return;
            }

            const todayISO = localISODate(new Date());
            const isToday = bookingState.dateISO === todayISO;

            let nowCutoff = -1;
            if (isToday) {
                const n = new Date();
                nowCutoff = n.getHours() * 60 + n.getMinutes() + BOOKING_CONFIG.todayBufferMinutes;
            }

            console.log(startMinutesList);
            
            let anyClickable = false;
            for (const mins of startMinutesList) {
                const label = minutesToClockLabel(mins);
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'time-slot' + (bookingState.timeLabel === label ? ' selected' : '');
                btn.textContent = label;
                const unavailable = isToday && mins < nowCutoff;
                btn.disabled = unavailable;
                if (!unavailable) {
                    anyClickable = true;
                    btn.addEventListener('click', () => selectTime(label));
                }
                wrap.appendChild(btn);
            }

            if (!anyClickable) {
                wrap.innerHTML = '';
                const p = document.createElement('p');
                p.className = 'booking-empty-times';
                p.textContent = 'انتهت الأوقات المتاحة لهذا اليوم. اختر غدًا أو يومًا لاحقًا.';
                wrap.appendChild(p);
            }
        }

        function syncSummaryLines() {
            document.getElementById('sum-date').textContent = bookingState.dateISO
                ? formatDateSummary(bookingState.dateISO)
                : 'لم يتم الاختيار';
            document.getElementById('sum-time').textContent = bookingState.timeLabel || 'لم يتم الاختيار';
        }

        function isValidSaudiMobile(input) {
            let d = String(input || '').replace(/\D/g, '');
            if (d.startsWith('966')) d = d.slice(3);
            if (d.startsWith('0')) d = d.slice(1);
            return /^5[0-9]{8}$/.test(d);
        }

        function updateConfirmEnabled() {
            const nameOk = document.getElementById('booking-customer-name').value.trim().length >= 2;
            const phoneOk = isValidSaudiMobile(document.getElementById('booking-customer-phone').value);
            const ok =
                bookingState.serviceId != null &&
                bookingState.dateISO &&
                bookingState.timeLabel &&
                nameOk &&
                phoneOk;
            document.getElementById('confirm-booking-btn').disabled = !ok;
        }

        function scrollToBookingEl(el) {
            if (!el) return;
            requestAnimationFrame(() => {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }

        /**
         * موبايل: خطوة واحدة + الملخص بعد الوقت فقط (main يختفي بعد اختيار الوقت).
         * سطح المكتب: عمودان — ملخص sticky بعد اختيار الخدمة يتحدّث؛ الحقول بعد الوقت؛ main يبقى مع بطاقة «تم» بعد الوقت.
         */
        function updateWizardUI() {
            const root = document.querySelector('.main-content');
            const mainCol = document.querySelector('.booking-main-col');
            const stepSvc = document.getElementById('wizard-step-service');
            const stepDate = document.getElementById('booking-step-date');
            const stepTime = document.getElementById('booking-step-time');
            const deskAside = document.getElementById('wizard-step-desktop-aside');
            const summary = document.getElementById('booking-details');

            const wide = isBookingWideViewport();
            const hasSvc = bookingState.serviceId != null;
            const hasDate = !!bookingState.dateISO;
            const hasTime = !!bookingState.timeLabel;

            stepSvc.classList.toggle('is-hidden', hasSvc);
            stepDate.classList.toggle('is-hidden', !hasSvc || hasDate);
            stepTime.classList.toggle('is-hidden', !hasDate || hasTime);

            const summaryVisible = hasTime || (wide && hasSvc);
            summary.classList.toggle('show', summaryVisible);
            summary.classList.toggle('booking-summary--contact', hasTime);

            root.classList.toggle('main-content--with-sidebar', wide && hasSvc);

            mainCol.classList.toggle('is-hidden', hasTime && !wide);

            const showDeskAside = wide && hasTime;
            deskAside.classList.toggle('is-hidden', !showDeskAside);
            deskAside.setAttribute('aria-hidden', showDeskAside ? 'false' : 'true');
        }

        function goBackToServiceStep() {
            bookingState.serviceId = null;
            bookingState.dateISO = null;
            bookingState.timeLabel = null;
            document.querySelectorAll('.service-grid-card').forEach((c) => c.classList.remove('selected'));
            document.getElementById('booking-details').classList.remove('show');
            document.getElementById('booking-service-block').innerHTML = '';
            document.getElementById('time-slots-container').innerHTML = '';
            syncSummaryLines();
            renderDateChips();
            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('wizard-step-service'));
        }

        function goBackToDateStep() {
            bookingState.dateISO = null;
            bookingState.timeLabel = null;
            document.getElementById('booking-details').classList.remove('show');
            document.getElementById('time-slots-container').innerHTML = '';
            syncSummaryLines();
            renderDateChips();
            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('booking-step-date'));
        }

        function goBackToTimeStep() {
            bookingState.timeLabel = null;
            document.getElementById('booking-details').classList.remove('show');
            syncSummaryLines();
            renderTimeSlots();
            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('booking-step-time'));
        }

        function selectDate(iso) {
            bookingState.dateISO = iso;
            bookingState.timeLabel = null;
            document.querySelectorAll('#date-chips-container .date-chip').forEach((el) => {
                el.classList.toggle('selected', el.dataset.iso === iso);
            });
            renderTimeSlots();
            syncSummaryLines();
            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('booking-step-time'));
        }

        function selectTime(label) {
            bookingState.timeLabel = label;
            document.querySelectorAll('#time-slots-container .time-slot').forEach((el) => {
                if (el.disabled) return;
                el.classList.toggle('selected', el.textContent === label);
            });
            syncSummaryLines();
            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('booking-details'));
        }

        function selectService(id) {
            document.querySelectorAll('.service-grid-card').forEach((card) => card.classList.remove('selected'));
            const selectedCard = document.getElementById('service-' + id);
            if (selectedCard) selectedCard.classList.add('selected');

            const service = services.find((s) => s.id === id);
            if (!service) return;

            bookingState.serviceId = id;
            bookingState.dateISO = null;
            bookingState.timeLabel = null;

            renderServiceBlock(service);
            syncSummaryLines();

            renderDateChips();
            document.getElementById('time-slots-container').innerHTML = '';

            updateWizardUI();
            updateConfirmEnabled();
            scrollToBookingEl(document.getElementById('booking-step-date'));
        }

        document.getElementById('wizard-back-to-service').addEventListener('click', goBackToServiceStep);
        document.getElementById('wizard-back-to-date').addEventListener('click', goBackToDateStep);
        document.getElementById('wizard-back-to-time').addEventListener('click', goBackToTimeStep);
        document.getElementById('wizard-back-to-time-desktop').addEventListener('click', goBackToTimeStep);

        document.getElementById('booking-customer-name').addEventListener('input', updateConfirmEnabled);
        document.getElementById('booking-customer-phone').addEventListener('input', updateConfirmEnabled);

        mqBookingWide.addEventListener('change', () => {
            updateWizardUI();
        });

        updateWizardUI();

        const bookingFeedbackEl = document.getElementById('booking-feedback');

        function setBookingFeedback(type, message) {
            if (!message) {
                bookingFeedbackEl.classList.remove('is-visible', 'booking-feedback--success', 'booking-feedback--error');
                bookingFeedbackEl.textContent = '';
                return;
            }
            bookingFeedbackEl.classList.remove('booking-feedback--success', 'booking-feedback--error');
            bookingFeedbackEl.classList.add('is-visible', type === 'success' ? 'booking-feedback--success' : 'booking-feedback--error');
            bookingFeedbackEl.textContent = message;
        }

        function firstValidationError(errors) {
            if (!errors || typeof errors !== 'object') return null;
            for (const key of Object.keys(errors)) {
                const arr = errors[key];
                if (Array.isArray(arr) && arr.length) return arr[0];
            }
            return null;
        }

        document.getElementById('confirm-booking-btn').addEventListener('click', async function () {
            if (this.disabled) return;
            setBookingFeedback(null, null);

            const btn = this;
            const nameEl = document.getElementById('booking-customer-name');
            const phoneEl = document.getElementById('booking-customer-phone');

            btn.classList.add('is-busy');
            const labelSpan = btn.querySelector('.confirm-button-text span:last-child');
            const prevLabel = labelSpan ? labelSpan.textContent : '';
            if (labelSpan) labelSpan.textContent = 'جاري الإرسال...';

            try {
                const res = await fetch(BOOKING_STORE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        service_id: bookingState.serviceId,
                        booking_date: bookingState.dateISO,
                        booking_time: bookingState.timeLabel,
                        customer_name: nameEl.value.trim(),
                        customer_phone: phoneEl.value.trim(),
                    }),
                });

                const data = await res.json().catch(() => ({}));

                if (res.ok) {
                    document.querySelector('.main-content').style.display = 'none';
                    document.querySelector('.confirmed').classList.remove('hidden');
                    return;
                }

                if (res.status === 422) {
                    const msg = firstValidationError(data.errors) || data.message || 'تحقق من البيانات المدخلة.';
                    setBookingFeedback('error', msg);
                    return;
                }

                setBookingFeedback('error', data.message || 'حدث خطأ. حاول مرة أخرى.');
            } catch (e) {
                setBookingFeedback('error', 'تعذر الاتصال بالخادم. تحقق من الشبكة وحاول مجددًا.');
            } finally {
                btn.classList.remove('is-busy');
                if (labelSpan) labelSpan.textContent = prevLabel || 'تأكيد الحجز';
            }
        });
    </script>
@endsection
