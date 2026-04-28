@extends('layout.web')

@section('style')
    <style>
        /* Page layout (matches screenshot spacing/feel) */
        .section {
            padding: 56px 0;
        }

        .section--alt {
            background: var(--c-surface);
            border-top: 1px solid rgba(232, 239, 243, .9);
            border-bottom: 1px solid rgba(232, 239, 243, .9);
        }

        .eyebrow {
            color: var(--c-primary);
            font-weight: 700;
            font-size: 12px;
            letter-spacing: .2px;
            margin: 0 0 10px;
        }

        .h1 {
            margin: 0 0 12px;
            font-weight: 800;
            font-size: 34px;
            line-height: 1.25;
            color: var(--c-text);
        }

        .lead {
            margin: 0 0 18px;
            color: var(--c-muted);
            font-size: 14px;
            max-width: 560px;
        }

        .hero {
            padding: 44px 0 36px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 28px;
            align-items: center;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-ghost {
            border: 1px solid var(--c-border);
            background: #fff;
            color: var(--c-text);
        }

        .hero-media {
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            justify-items: start;
        }

        .hero-card {
            width: min(420px, 100%);
            border-radius: 18px;
            border: 1px solid rgba(232, 239, 243, .9);
            background: #fff;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(15, 36, 48, .08);
        }

        .hero-img {
            height: 450px;
            /* width: 100%; */
            background-image: url('web/hero.jpg');
            background-size: cover;
            position: relative;
        }

        /* .hero-img::after{
            content:"";
            position:absolute;
            inset:0;
            background:
                linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.75));
            pointer-events:none;
        } */

        .rating-pill {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 999px;
            padding: 8px 10px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 24px rgba(15, 36, 48, .10);
            font-weight: 800;
            font-size: 12px;
        }

        .rating-star {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(45,111,134,.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--c-primary);
            font-weight: 900;
            line-height: 1;
        }

        .services-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .services-subtitle {
            text-align: center;
            margin: 0 auto 26px;
            color: var(--c-muted);
            font-size: 13px;
            max-width: 720px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .card {
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 16px;
            padding: 18px 16px;
            box-shadow: 0 10px 26px rgba(15, 36, 48, .06);
        }

        .card-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(45,111,134,.10);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--c-primary);
            font-weight: 900;
            margin-bottom: 10px;
            user-select: none;
        }

        .card-title {
            margin: 0 0 6px;
            font-weight: 800;
            font-size: 14px;
            color: var(--c-text);
        }

        .card-text {
            margin: 0;
            color: var(--c-muted);
            font-size: 12.5px;
        }

        .why-grid {
            display: grid;
            grid-template-columns: .95fr 1.05fr;
            gap: 22px;
            align-items: center;
        }

        .why-media {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .why-photo {
            border-radius: 16px;
            border: 1px solid rgba(232, 239, 243, .95);
            overflow: hidden;
            height: 170px;
            background-image: url('web/card.avif');
            background-size: cover;
        }

        .why-photo--2 {
            background-image: url('web/hero.jpg');
            background-size: cover;
        }

        .why-list {
            margin: 18px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 12px;
            color: var(--c-muted);
            font-size: 13px;
        }

        .why-item {
            display: grid;
            grid-template-columns: 22px 1fr;
            gap: 10px;
            align-items: start;
        }

        .check {
            width: 22px;
            height: 22px;
            border-radius: 8px;
            background: rgba(45,111,134,.12);
            color: var(--c-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            line-height: 1;
            margin-top: 1px;
        }

        .doctors-title {
            text-align: center;
            margin-bottom: 26px;
        }

        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .doctor-card {
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(15, 36, 48, .06);
        }

        .doctor-body {
            padding: 14px 14px 16px;
        }

        .doctor-name {
            margin: 0 0 4px;
            font-weight: 800;
            font-size: 14px;
        }

        .doctor-role {
            margin: 0;
            color: var(--c-muted);
            font-size: 12.5px;
        }

        .cta {
            background: #3c6b80;
            color: #fff;
            border-radius: 0;
        }

        .cta-inner {
            padding: 52px 0;
            text-align: center;
        }

        .cta-title {
            margin: 0 0 10px;
            font-weight: 800;
            font-size: 26px;
        }

        .cta-text {
            margin: 0 auto 18px;
            opacity: .9;
            font-size: 13px;
            max-width: 700px;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            padding: 0 18px;
            border-radius: 999px;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.25);
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            font-size: 13px;
        }

        .cta-btn:hover {
            background: rgba(255,255,255,.22);
        }

        /* Responsive */
        @media (max-width: 980px) {
            .hero-grid { grid-template-columns: 1fr; }
            .why-grid { grid-template-columns: 1fr; }
            .cards-grid, .doctor-grid { grid-template-columns: 1fr; }
            .hero-media { justify-items: stretch; }
            .hero-card { width: 100%; }
        }
    </style>
@endsection

@section('content')
    {{-- HERO --}}
    <section class="hero">
        <div class="web-container">
            <div class="hero-grid">
                <div>
                    <p class="eyebrow">مرحبا بك في عيادة دريما للجمال</p>
                    <h1 class="h1">الجديـد لموديلات الترند مع أفضل أطباء التجميل في الرياض</h1>
                    <p class="lead">
                        نحن نقدم رعاية متكاملة وخدمات تجميل متقدمة بجودة عالية واهتمام بالتفاصيل لتجربة مريحة وآمنة.
                    </p>

                    <div class="hero-actions">
                        <a class="web-btn web-btn-primary" href="{{ url('/book-appointment') }}">احجز الآن</a>
                        <a class="web-btn btn-ghost" href="{{ url('/contact-us') }}">تواصل معنا</a>
                    </div>
                </div>

                <div class="hero-media">
                    <div class="hero-card" aria-hidden="true">
                        <div class="hero-img">
                            <div class="rating-pill">
                                <span class="rating-star">★</span>
                                <span>4.9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="section section--alt" id="services">
        <div class="web-container">
            <div class="services-title">
                <div class="eyebrow">خدماتنا التجميلية</div>
                <div style="font-weight:800;font-size:20px;color:var(--c-text);">خدماتنا التجميلية</div>
            </div>
            <p class="services-subtitle">
                نقدم باقة من الخدمات التي تلبي احتياجاتك الجمالية، بإشراف مختصين وبأحدث التقنيات.
            </p>

            <div class="cards-grid">
                @foreach($cards as $card)
                    <div class="card">
                        <div class="card-icon" style="padding: 6px">
                            <img src="{{asset('storage/'.$card->icon)}}">
                        </div>
                        <h3 class="card-title">{{$card->name}}</h3>
                        <p class="card-text">{{$card->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY DREAMA --}}
    <section class="section" id="about">
        <div class="web-container">
            <div class="why-grid">
                <div class="why-media" aria-hidden="true">
                    <div class="why-photo"></div>
                    <div class="why-photo why-photo--2"></div>
                </div>

                <div>
                    <div class="eyebrow">لماذا عيادة دريما؟</div>
                    <div style="font-weight:800;font-size:20px;color:var(--c-text); margin-bottom:10px;">لماذا عيادة دريما؟</div>
                    <p class="lead" style="margin-bottom:0;">
                        نركز على تجربة متكاملة تجمع بين الخبرة، التقنيات الحديثة، والمعايير الطبية لضمان أفضل النتائج.
                    </p>

                    <ul class="why-list">
                        <li class="why-item">
                            <span class="check">✓</span>
                            <span>كوادر طبية مختصة وخبرة عالية في التجميل.</span>
                        </li>
                        <li class="why-item">
                            <span class="check">✓</span>
                            <span>أجهزة وتقنيات حديثة بمعايير أمان معتمدة.</span>
                        </li>
                        <li class="why-item">
                            <span class="check">✓</span>
                            <span>خطة علاج شخصية ومتابعة دقيقة لنتائج أفضل.</span>
                        </li>
                        <li class="why-item">
                            <span class="check">✓</span>
                            <span>بيئة مريحة وخصوصية كاملة وتجربة سلسة.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- DOCTORS --}}
    <section class="section section--alt" id="doctors">
        <div class="web-container">
            <div class="doctors-title">
                <div class="eyebrow">تعرف على أطباء التجميل</div>
                <div style="font-weight:800;font-size:20px;color:var(--c-text);">تعرف على أطباء التجميل</div>
            </div>

            <div class="doctor-grid" id="team">
                @foreach($doctors as $doctor)
                    <article class="doctor-card">
                        <div 
                        class="doctor-photo" 
                        aria-hidden="true"
                        style="
                            height: 400px;
                            background: url('{{asset('storage/'.$doctor->photo)}}');
                            background-size: cover;
                            background-position: center;
                        "   
                        ></div>
                        <div class="doctor-body">
                            <h3 class="doctor-name">{{$doctor->name}}</h3>
                            <p class="doctor-role">{{$doctor->specialization}}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>


@endsection

