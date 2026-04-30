<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root{
            --c-text:#0f2430;
            --c-muted:#6b7f8c;
            --c-border:#e8eff3;
            --c-bg:#ffffff;
            --c-surface:#f6fbfd;
            --c-primary:#2d6f86;
            --c-primary-2:#3f7f96;
            --radius:14px;
            --container:1120px;
        }

        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:"Tajawal", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background:var(--c-bg);
            color:var(--c-text);
            line-height:1.65;
        }

        a{color:inherit}

        .web-container{
            width:min(var(--container), calc(100% - 40px));
            margin-inline:auto;
        }

        /* Navbar */
        .web-nav{
            background:#fff;
            border-bottom:1px solid rgba(232,239,243,.9);
        }
        .web-nav-inner{
            height:72px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:18px;
        }

        .web-brand{
            font-weight:800;
            white-space:nowrap;
            text-decoration:none;
            letter-spacing:.1px;
            font-size:16px;
        }

        .web-menu{
            display:flex;
            align-items:center;
            gap:26px;
            margin:0;
            padding:0;
            list-style:none;
            color:rgba(15,36,48,.85);
            font-weight:500;
            font-size:14px;
        }

        .web-menu a{
            text-decoration:none;
            opacity:.9;
        }
        .web-menu a:hover{opacity:1;color:var(--c-primary)}

        .web-cta{
            display:flex;
            align-items:center;
            gap:10px;
        }
        .web-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            height:38px;
            padding:0 16px;
            border-radius:999px;
            border:1px solid var(--c-border);
            background:#fff;
            text-decoration:none;
            font-weight:700;
            font-size:13px;
            color:var(--c-text);
            transition:background .15s ease, border-color .15s ease, color .15s ease;
        }
        .web-btn:hover{
            border-color:#d7e4eb;
            background:#fbfdfe;
        }

        .web-btn-primary{
            background:var(--c-primary);
            border-color:var(--c-primary);
            color:#fff;
        }
        .web-btn-primary:hover{
            background:var(--c-primary-2);
            border-color:var(--c-primary-2);
        }

        .web-burger{
            display:none;
            border:1px solid var(--c-border);
            background:#fff;
            border-radius:12px;
            width:44px;
            height:40px;
            padding:0;
            cursor:pointer;
        }
        .web-burger span{
            display:block;
            width:18px;
            height:2px;
            margin:4px auto;
            background:rgba(15,36,48,.75);
            border-radius:2px;
        }

        /* Footer */
        .web-footer{
            margin-top:48px;
            background:var(--c-surface);
            border-top:1px solid var(--c-border);
        }
        .web-footer-inner{
            padding:44px 0 22px;
        }
        .web-footer-grid{
            display:grid;
            grid-template-columns: 1.15fr .9fr .9fr 1fr;
            gap:22px;
        }
        .web-footer-title{
            font-weight:800;
            margin:0 0 10px;
            font-size:14px;
        }
        .web-footer-text{
            margin:0;
            color:var(--c-muted);
            font-size:13px;
        }
        .web-footer-list{
            list-style:none;
            margin:0;
            padding:0;
            display:grid;
            gap:10px;
            color:var(--c-muted);
            font-size:13px;
        }
        .web-footer-list a{
            text-decoration:none;
            color:var(--c-muted);
        }
        .web-footer-list a:hover{color:var(--c-primary)}

        .web-footer-bottom{
            margin-top:26px;
            padding-top:16px;
            border-top:1px solid rgba(232,239,243,.9);
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            color:var(--c-muted);
            font-size:12px;
        }
        .web-footer-bottom a{
            color:var(--c-muted);
            text-decoration:none;
        }
        .web-footer-bottom a:hover{color:var(--c-primary)}

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
        @media (max-width: 980px){
            .web-burger{display:inline-block}
            .web-menu{
                display:none;
                position:absolute;
                inset-inline:20px;
                top:72px;
                background:#fff;
                border:1px solid var(--c-border);
                border-radius:var(--radius);
                padding:14px 14px;
                gap:12px;
                flex-direction:column;
                align-items:flex-start;
                box-shadow:0 12px 30px rgba(15,36,48,.08);
            }
            .web-menu.is-open{display:flex}
            .web-nav-inner{position:relative}

            .web-footer-grid{
                grid-template-columns:1fr 1fr;
            }
        }
        @media (max-width: 520px){
            .web-footer-grid{grid-template-columns:1fr}
            .web-footer-bottom{flex-direction:column; align-items:flex-start}
        }
                .float-whatsapp {
            position: fixed;
            right: 30px;
            bottom: 30px;
            background: #008000;
            padding: 5px;
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }
        .float-whatsapp a {
            display: block;
        }
        .float-whatsapp i {
            font-size: 44px;
            color: #fff;
        }
    </style>

    @yield('style')
</head>
<body>
@if (session('success'))
    <div id="flashMessage"
         class="fixed top-4 left-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white bg-green-600">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="flashMessage"
         class="fixed top-4 left-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white bg-red-600">
        {{ session('error') }}
    </div>
@endif
<header class="web-nav">
    <div class="web-container">
        <div class="web-nav-inner">
            <a class="web-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

            <button class="web-burger" type="button" aria-label="القائمة" aria-controls="webMenu" aria-expanded="false" onclick="window.__toggleWebMenu?.()">
                <span></span><span></span><span></span>
            </button>

            <ul class="web-menu" id="webMenu">
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li><a href="{{ url('/services-web') }}">الخدمات</a></li>
                <li><a href="{{ url('/doctors-web') }}">الأطباء</a></li>
                <li><a href="{{ url('/contact-us') }}">تواصل معنا</a></li>
            </ul>

            <div class="web-cta">
                <a class="web-btn" href="{{ url('/contact-us') }}">تواصل معنا</a>
                <a class="web-btn web-btn-primary" href="{{ url('/book-appointment') }}">احجز الآن</a>
            </div>
        </div>
    </div>
</header>

<main>
    @yield('content')

    {{-- CTA --}}
    @if (!request()->is('book-appointment'))
        <section class="cta">
            <div class="web-container">
                <div class="cta-inner">
                    <div class="cta-title">ابدئي رحلتك الجمالية اليوم</div>
                    <p class="cta-text">
                        احجزي موعدك الآن واستمتعي بتجربة عناية متكاملة مع فريق متخصص وخدمات تناسب احتياجك.
                    </p>
                    <a class="cta-btn" href="{{ url('/book-appointment') }}">احجز الآن</a>
                </div>
            </div>
        </section>
    @endif
</main>

<footer class="web-footer">
    <div class="web-container">
        <div class="web-footer-inner">
            <div class="web-footer-grid">
                <div>
                    <div class="web-footer-title">عيادة دريما للجمال</div>
                    <p class="web-footer-text">
                        خبراء في علاجات التجميل والعناية بالبشرة باستخدام أحدث التقنيات وبأيدي مختصين.
                    </p>
                </div>

                <div>
                    <div class="web-footer-title">روابط سريعة</div>
                    <ul class="web-footer-list">
                        <li><a href="{{ url('/') }}">الرئيسية</a></li>
                        <li><a href="{{ url('/services-web') }}">الخدمات</a></li>
                        <li><a href="{{ url('/doctors-web') }}">الأطباء</a></li>
                    </ul>
                </div>

                <div>
                    <div class="web-footer-title">روابط أخرى</div>
                    <ul class="web-footer-list">
                        <li><a href="{{ url('/doctors-web') }}">تعرف على أطباء التجميل</a></li>
                        <li><a href="{{ url('/contact-us') }}">تواصل معنا</a></li>
                    </ul>
                </div>

                <div id="contact">
                    <div class="web-footer-title">تواصل معنا</div>
                    @php
                        $phone = optional(\App\Models\Setting::where('var','phone')->first())->value;
                        $email = optional(\App\Models\Setting::where('var','email')->first())->value;
                    @endphp
                    <ul class="web-footer-list">
                        <li>📍 الرياض، المملكة العربية السعودية</li>
                        <li>
                            📞 <a href="tel:{{ $phone }}">{{ $phone }}</a>
                        </li>

                        <li>
                            ✉️ <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="web-footer-bottom">
                <div>© {{ date('Y') }} جميع الحقوق محفوظة</div>
                <div style="display:none; gap:14px; align-items:center;">
                    <a href="#">سياسة الخصوصية</a>
                    <a href="#">الشروط والأحكام</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="float-whatsapp">
    <a href="https://wa.me/{{ optional(\App\Models\Setting::where('var','whatsapp')->first())->value }}">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<script>
    window.__toggleWebMenu = function () {
        const menu = document.getElementById('webMenu');
        if (!menu) return;
        menu.classList.toggle('is-open');
    }
</script>
<script>
    setTimeout(() => {
        const el = document.getElementById('flashMessage');
        if (el) {
            el.style.transition = 'all 0.5s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-10px)';

            setTimeout(() => el.remove(), 500);
        }
    }, 5000);
</script>
<script src="https://cdn.tailwindcss.com"></script>
@yield('script')
</body>
</html>

