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
    .booking-section {
        background: white;
        padding: 40px 20px;
        border-radius: 12px;
        margin-bottom: 40px;
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
    .main-content {
        display: flex;
        flex-direction: row;
        gap: 40px;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        width: 100%;
        max-width: 650px;
    }
    .service-grid-card {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        justify-content: flex-end;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: right;
        min-height: auto;
        position: relative;
        gap: 16px;
        direction: rtl;
    }
    .service-grid-card:hover {
        border-color: #d1d5db;
        background: #f3f4f6;
    }
    .service-grid-card.selected {
        border: 3px solid var(--c-primary);
        background: #fffbf0;
        box-shadow: 0 0 0 3px rgb(45 111 134);
    }
    .service-grid-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #4b5563;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        overflow: hidden;
        margin-bottom: 0;
        flex-shrink: 0;
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
        max-width: 320px;
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
    .summary-item:last-child {
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
    .confirm-button:hover {
        background: #7bb3c0;
    }
    .confirm-button-text {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    @media (max-width: 900px) {
        .main-content {
            flex-direction: column;
            align-items: center;
        }
        .services-grid {
            max-width: 100%;
        }
        .booking-summary {
            max-width: 100%;
        }
    }
    @media (max-width: 600px) {
        .services-grid {
            grid-template-columns: 1fr;
            gap: 16px;
            max-width: 100%;
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
    <div class="booking-section">
        
        <div class="step-header">
            <span class="step-number">1</span>
            <span class="step-title">اختيار الخدمة</span>
        </div>
        
        <div class="main-content">
            
            <div class="booking-summary" id="booking-details">
                <div class="summary-title">ملخص الحجز</div>
                <div id="booking-content"></div>
                <button class="confirm-button">
                    <span class="confirm-button-text">
                        <span>✓</span>
                        <span>تأكيد الحجز</span>
                    </span>
                </button>
                <div style="font-size:0.85rem; color:#9ca3af; text-align:center; margin-top:8px;">يرجى اكمال جميع الخطوات لتأكيد الحجز</div>
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
    </div>
@endsection

@section('script')
    <script>
        const services = @json($services);
        function selectService(id) {
            // إزالة التحديد من جميع الكروت
            document.querySelectorAll('.service-grid-card').forEach(card => {
                card.classList.remove('selected');
            });
            // تمييز الكارت المختار
            const selectedCard = document.getElementById('service-' + id);
            if(selectedCard) selectedCard.classList.add('selected');

            // عرض تفاصيل الحجز
            const service = services.find(s => s.id === id);
            if(service) {
                const bookingDetails = document.getElementById('booking-details');
                bookingDetails.classList.add('show');
                document.getElementById('booking-content').innerHTML = `
                    <div class="summary-item">
                        <span class="summary-label">الخدمة</span>
                        <span class="summary-value">${service.name}</span>
                    </div>
                    ${service.price ? `
                    <div class="summary-item">
                        <span class="summary-label">السعر</span>
                        <span class="summary-value">${service.price}</span>
                    </div>`
                    : ''}
                    ${service.duration ? `
                    <div class="summary-item">
                        <span class="summary-label">وقت التنفيذ</span>
                        <span class="summary-value">${service.duration} دقيقة</span>
                    </div>`
                    : ''}
                    <div class="summary-item">
                        <span class="summary-label">التاريخ والوقت</span>
                        <span class="summary-value">لم يتم الاختيار</span>
                    </div>
                `;
            }
        }
    </script>
@endsection
