@extends('layout.web')

@section('style')
    <style>
        .doc-hero {
            padding: 46px 0 26px;
            background: var(--c-surface);
            border-bottom: 1px solid rgba(232, 239, 243, .9);
            text-align: center;
        }

        .doc-hero h1 {
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 30px;
            color: var(--c-text);
        }

        .doc-hero p {
            margin: 0 auto;
            max-width: 760px;
            color: var(--c-muted);
            font-size: 13px;
            line-height: 1.9;
        }

        .doc-wrap {
            background: var(--c-surface);
            padding: 28px 0 56px;
        }

        .doc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 20px;
        }

        .doc-grid--2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            max-width: 760px;
            margin: 18px auto 0;
        }

        .doc-card {
            background: #fff;
            border: 1px solid rgba(232, 239, 243, .95);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(15, 36, 48, .06);
            padding: 18px 16px 16px;
            text-align: center;
        }

        .doc-avatar {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            margin: 2px auto 10px;
            background:
                radial-gradient(60px 60px at 35% 35%, rgba(45,111,134,.25), transparent 65%),
                linear-gradient(135deg, #1b2e38, #0e1b23);
            border: 6px solid #fff;
            box-shadow: 0 10px 20px rgba(15, 36, 48, .10);
        }

        .doc-name {
            margin: 0 0 4px;
            font-weight: 800;
            font-size: 14px;
            color: var(--c-text);
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

        .doc-desc {
            margin: 0 0 14px;
            color: var(--c-muted);
            font-size: 12.5px;
            line-height: 1.9;
            min-height: 64px;
        }

        .doc-btn {
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
        }

        .doc-btn:hover {
            background: rgba(45, 111, 134, .78);
            border-color: rgba(45, 111, 134, .78);
            color: #fff;
        }

        @media (max-width: 980px) {
            .doc-grid { grid-template-columns: repeat(2, 1fr); }
            .doc-grid--2 { grid-template-columns: 1fr; max-width: none; }
        }
        @media (max-width: 650px) {
            .doc-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <section class="doc-hero">
        <div class="web-container">
            <h1>نخبة من أفضل الأطباء</h1>
            <p>
                نقدم في عيادة دريما نخبة من الاستشاريين والأخصائيين ذوي الخبرة الواسعة لتقديم أفضل
                رعاية طبية وتجميلية وفق أعلى المعايير العالمية.
            </p>
        </div>
    </section>

    <section class="doc-wrap">
        <div class="web-container doc-grid">

            @foreach($doctors as $doctor)
                <article class="doc-card">

                    @if($doctor->photo)
                        <img class="doc-avatar" src="{{ asset('storage/'.$doctor->photo) }}">
                    @else
                        <div class="doc-avatar"></div>
                    @endif

                    <h3 class="doc-name">{{ $doctor->name }}</h3>

                    @if($doctor->specialization)
                        <p class="doc-role">{{ $doctor->specialization }}</p>
                    @endif

                    @if($doctor->experience)
                        <div class="doc-pill">خبرة +{{ $doctor->experience }} سنوات</div>
                    @endif

                    @if($doctor->description)
                        <p class="doc-desc">{{ $doctor->description }}</p>
                    @endif

                    <a class="doc-btn" href="{{ url('/book-appointment') }}">احجز موعد</a>

                </article>
            @endforeach

        </div>
    </section>
@endsection

