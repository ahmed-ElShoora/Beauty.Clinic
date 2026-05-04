@extends('layout.web')

@section('style')
    <style>
        .cu-hero {
            padding: 46px 0 20px;
            background: var(--c-surface);
            border-bottom: 1px solid rgba(232, 239, 243, .9);
            text-align: center;
        }

        .cu-hero h1 {
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 28px;
            color: var(--c-text);
        }

        .cu-hero p {
            margin: 0 auto;
            max-width: 760px;
            color: var(--c-muted);
            font-size: 13px;
            line-height: 1.9;
        }

        .cu-wrap {
            background: var(--c-surface);
            padding: 24px 0 56px;
        }

        .cu-grid {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 18px;
            align-items: start;
        }

        .cu-grid > div.first {
            display: flex;
            width: 100%;
            flex-direction: column;
        }
        .cu-card {
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(15, 36, 48, .06);
        }

        .cu-card-pad { padding: 18px 16px; }

        .mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .mini {
            text-align: center;
            padding: 18px 16px;
        }

        .mini-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: grid;
            place-items: center;
            font-weight: 900;
            color: var(--c-primary);
            background: rgba(45,111,134,.10);
            border: 1px solid rgba(45,111,134,.12);
        }

        .mini h3 {
            margin: 0 0 6px;
            font-weight: 800;
            font-size: 14px;
        }

        .mini p {
            margin: 0 0 12px;
            color: var(--c-muted);
            font-size: 12.5px;
            line-height: 1.8;
        }

        .mini a.btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 14px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 13px;
            text-decoration: none;
            border: 1px solid rgba(45,111,134,.55);
            color: var(--c-primary);
            background: #fff;
            width: 100%;
        }

        .mini a.btn--wa {
            background: #23c55e;
            border-color: #23c55e;
            color: #fff;
        }

        .hours {
            padding: 16px 16px;
        }

        .hours-title {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin: 0 0 12px;
            font-weight: 800;
            font-size: 14px;
            color: var(--c-text);
        }

        .hours-row {
            display: grid;
            grid-template-columns: 1fr 6fr;
            gap: 12px;
            padding: 12px 0;
            border-top: 1px solid rgba(232, 239, 243, .9);
            color: var(--c-muted);
            font-size: 13px;
            align-items: center;
        }

        .hours-row:first-of-type { border-top: 0; padding-top: 6px; }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 28px;
            padding: 0 12px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 12px;
            border: 1px solid rgba(232, 239, 243, .95);
            background: rgba(45,111,134,.10);
            color: var(--c-primary);
            justify-self: start;
        }

        .pill--closed {
            background: rgba(239, 68, 68, .10);
            border-color: rgba(239, 68, 68, .16);
            color: #b42318;
        }

        .map {
            overflow: hidden;
            border-radius: 18px;
            border: 1px solid rgba(232, 239, 243, .95);
            height: 230px;
            background:
                radial-gradient(180px 120px at 50% 55%, rgba(255,255,255,.15), transparent 60%),
                linear-gradient(135deg, #1f2937, #0b1220);
            position: relative;
        }

        .map-pin {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            color: #fff;
            opacity: .9;
            font-weight: 900;
        }

        .form {
            padding: 22px 18px 18px;
        }

        .form h2 {
            margin: 0 0 6px;
            font-weight: 800;
            font-size: 16px;
            color: var(--c-text);
        }

        .form p {
            margin: 0 0 14px;
            color: var(--c-muted);
            font-size: 12.5px;
        }

        .field {
            margin-bottom: 12px;
        }

        .label {
            display: block;
            margin: 0 0 6px;
            font-weight: 800;
            font-size: 12px;
            color: rgba(15,36,48,.75);
        }

        .input, .textarea {
            width: 100%;
            border-radius: 10px;
            border: 1px solid rgba(232, 239, 243, .95);
            background: rgba(45,111,134,.08);
            padding: 12px 12px;
            font-family: inherit;
            outline: none;
            color: var(--c-text);
            font-size: 13px;
        }

        .textarea { min-height: 92px; resize: vertical; }

        .submit {
            width: 100%;
            height: 44px;
            border-radius: 12px;
            border: 0;
            background: rgba(45,111,134,.78);
            color: #fff;
            font-weight: 900;
            font-size: 13px;
            cursor: pointer;
        }

        .submit:hover { background: rgba(45,111,134,.88); }

        @media (max-width: 980px) {
            .cu-grid { grid-template-columns: 1fr; }
            .mini-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <section class="cu-hero">
        <div class="web-container">
            <h1>تواصل معنا</h1>
            <p>
                نحن هنا للإجابة على جميع استفساراتك وتقديم أفضل الخدمات التجميلية لك.
                لا تتردد في التواصل معنا.
            </p>
        </div>
    </section>

    <section class="cu-wrap">
        <div class="web-container">
            <div class="cu-grid">
                <div class="first">
                    <div class="mini-grid">
                        <div class="cu-card mini">
                            <div class="mini-icon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <h3>واتساب</h3>
                            <p>تواصل معنا مباشرة</p>
                            <a class="btn btn--wa" href="https://wa.me/{{ optional(\App\Models\Setting::where('var','whatsapp')->first())->value }}">محادثة واتساب</a>
                        </div>

                        <div class="cu-card mini">
                            <div class="mini-icon">☎</div>
                            <h3>رقم الهاتف</h3>
                            <p dir="ltr" style="margin-bottom:10px;">{{ optional(\App\Models\Setting::where('var','phone')->first())->value }}</p>
                            <a class="btn" href="tel:{{ optional(\App\Models\Setting::where('var','phone')->first())->value }}">اتصل الآن</a>
                        </div>
                    </div>
                    @php
                        $days = [
                            6 => 'السبت',
                            0 => 'الأحد',
                            1 => 'الإثنين',
                            2 => 'الثلاثاء',
                            3 => 'الأربعاء',
                            4 => 'الخميس',
                            5 => 'الجمعة',
                        ];
                    @endphp

                    <div class="cu-card hours">

                        <div class="hours-title">
                            <span>ساعات العمل</span>

                            <span style="width:28px;height:28px;border-radius:10px;background:rgba(45,111,134,.10);display:grid;place-items:center;color:var(--c-primary);font-weight:900;">
                                🕒
                            </span>
                        </div>

                        @foreach($days as $i => $day)

                            @php
                                $schedule = $data[$i] ?? null;
                            @endphp

                            <div class="hours-row">

                                <div>{{ $day }}</div>


                                    @if(!$schedule || $schedule->is_closed)
                                        <div dir="ltr">
                                            <span class="pill pill--closed">مغلق</span>
                                        </div>
                                    @else
                                        <div dir="ltr">

                                            @forelse($schedule->slots as $slot)
                                                <div style="display:inline-block">
                                                    <span class="pill">
                                                        {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                                    </span>
                                                </div>

                                                @if(!$loop->last)
                                                    <span style="margin:0 5px;">|</span>
                                                @endif

                                            @empty
                                                <span class="text-muted">لا يوجد مواعيد</span>
                                            @endforelse

                                        </div>

                                    @endif

                                </div>


                        @endforeach

                    </div>

                </div>

                <div class="cu-card form">
                    <h2>أرسل رسالة</h2>
                    <p>سنجيب على استفسارك في أقرب وقت ممكن.</p>

                    <form action="{{ url('/contact-us') }}" method="POST">
                        <div class="field">
                            <label class="label" for="name">الاسم الكامل</label>
                            <input class="input" id="name" name="name" type="text" placeholder="ادخل اسمك الكريم">
                        </div>

                        <div class="field">
                            <label class="label" for="phone">رقم الهاتف</label>
                            <input class="input" id="phone" name="phone" type="text" placeholder="05XXXXXXXXXX">
                        </div>

                        <div class="field">
                            <label class="label" for="message">الرسالة</label>
                            <textarea class="textarea" id="message" name="message" placeholder="كيف يمكننا مساعدتك؟"></textarea>
                        </div>

                        <button class="submit" type="submit">إرسال الرسالة</button>
                    </form>

                </div>

                <div class="map">
                    <iframe style="border-radius: 15px" width="600" height="230" id="gmap_canvas" src="{{ optional(\App\Models\Setting::where('var','map')->first())->value }}"></iframe>
                </div>

            </div>
        </div>
    </section>
@endsection

