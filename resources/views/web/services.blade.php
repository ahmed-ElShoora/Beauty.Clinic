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

        .services-wrap {
            padding: 28px 0 54px;
            background: var(--c-surface);
        }

        .svc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 22px;
        }

        .svc-card {
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(15, 36, 48, .06);
        }

        .svc-media {
            position: relative;
            height: 165px;
            background:
                radial-gradient(160px 120px at 30% 35%, rgba(45,111,134,.22), transparent 60%),
                linear-gradient(135deg, #dfeaf0, #f6fbfd);
        }

        .svc-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            color: #fff;
            background: rgba(45, 111, 134, .85);
            border: 1px solid rgba(255, 255, 255, .35);
            backdrop-filter: blur(6px);
        }

        .svc-body {
            padding: 14px 14px 16px;
        }

        .doc-role {
            margin: 0 0 8px;
            color: var(--c-muted);
            font-size: 12.5px;
        }

        .doc-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(45,111,134,.10);
            color: var(--c-primary);
            font-weight: 800;
            font-size: 11px;
            margin-bottom: 10px;
            border: 1px solid rgba(45,111,134,.12);
        }

        .svc-title {
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 15px;
            color: var(--c-text);
            text-align: center;
        }

        .svc-desc {
            margin: 0 0 14px;
            color: var(--c-muted);
            font-size: 12.5px;
            line-height: 1.9;
            text-align: center;
            min-height: 62px;
        }

        .svc-btn {
            width: 100%;
            height: 40px;
            border-radius: 999px;
            border: 1px solid rgba(45, 111, 134, .55);
            background: #fff;
            color: var(--c-primary);
            font-weight: 800;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background .15s ease, color .15s ease, border-color .15s ease;
        }

        .svc-btn:hover {
            background: rgba(45, 111, 134, .06);
        }

        .svc-btn--filled {
            background: rgba(45, 111, 134, .78);
            border-color: rgba(45, 111, 134, .78);
            color: #fff;
        }

        .svc-btn--filled:hover {
            background: rgba(45, 111, 134, .88);
            border-color: rgba(45, 111, 134, .88);
        }

        @media (max-width: 980px) {
            .svc-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <section class="page-hero">
        <div class="web-container">
            <h1>خدماتنا المتميزة</h1>
            <p>
                اكتشفي أحدث التقنيات والحلول الطبية التجميلية المصممة خصيصاً لإبراز جمالك الطبيعي
                وتوفير رعاية مثالية وتجربتكِ في بيئة من الراحة والفخامة والاطمئنان.
            </p>
        </div>
    </section>

    <section class="services-wrap">
        <div class="web-container">
            <div class="svc-grid">
                @foreach($services as $service)
                    <article class="svc-card">
                        <div class="svc-media" style="background-image:url({{asset('storage/'.$service->icon)}});background-position: center;background-size: cover;">
                            <span class="svc-tag">{{$service->patch}}</span>
                        </div>
                        <div class="svc-body">
                            <h3 class="svc-title">{{$service->name}}</h3>
                            @if($service->duration)
                                <p class="doc-pill">مدة تنفيذ الخدمة : {{ $service->duration }} دقيقة</p>
                            @endif

                            @if($service->price)
                                <div class="doc-pill">السعر : {{ $service->price }} ريال</div>
                            @endif
                            <p class="svc-desc">
                                {{$service->description}}
                            </p>
                            <a class="svc-btn" href="{{ url('/contact-us') }}">احجز الآن</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

