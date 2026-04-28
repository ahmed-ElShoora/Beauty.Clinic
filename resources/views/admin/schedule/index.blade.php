@extends('layout.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">مواعيد العيادة</h5>


                    <div class="card mb-4">
                        <div class="card-body">


                        {{-- Actions --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h6 class="mb-0">إدارة المواعيد الأسبوعية</h6>

                            <button type="button"
                                    class="btn btn-sm btn-primary"
                                    onclick="copyToAllDays()">
                                📋 نسخ يوم الأحد لباقي الأيام
                            </button>

                        </div>


                        <form method="POST">
                            @csrf

                            @php
                                $days = ['الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت'];
                            @endphp

                            <div class="row">

                                @foreach($days as $i => $day)
                                    @php $schedule = $schedules[$i]; @endphp

                                    <div class="col-md-6 mb-3">

                                        <div class="border rounded p-3 day-block"
                                             data-day="{{ $i }}">

                                            {{-- Header --}}
                                            <div class="d-flex justify-content-between align-items-center mb-2">

                                                <h6 class="mb-0">
                                                    {{ $day }}
                                                </h6>

                                                <div class="form-check form-switch">

                                                    <input class="form-check-input toggle-day"
                                                           type="checkbox"
                                                           name="days[{{ $i }}][is_closed]"
                                                           {{ $schedule->is_closed ? 'checked' : '' }}>

                                                    <label class="form-check-label">
                                                        مغلق
                                                    </label>

                                                </div>

                                            </div>


                                            {{-- Slots --}}
                                            <div class="slots">

                                                @if(!$schedule->is_closed)
                                                    @foreach($schedule->slots as $slot)
                                                        <div class="d-flex gap-2 mb-2 slot align-items-center">

                                                            <input type="time"
                                                                   class="form-control form-control-sm"
                                                                   name="days[{{ $i }}][slots][slot_{{ $slot->id ?? rand() }}][start]"
                                                                   value="{{ $slot->start_time }}">

                                                            <span>←</span>

                                                            <input type="time"
                                                                   class="form-control form-control-sm"
                                                                   name="days[{{ $i }}][slots][slot_{{ $slot->id ?? rand() }}][end]"
                                                                   value="{{ $slot->end_time }}">

                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger"
                                                                    onclick="removeSlot(this)">
                                                                ✕
                                                            </button>

                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>


                                            {{-- Add Slot --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary mt-2"
                                                    onclick="addSlot({{ $i }})">
                                                ➕ إضافة فترة
                                            </button>

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- Save --}}
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success">
                                    💾 حفظ المواعيد
                                </button>
                            </div>

                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
<script>

/* =========================
   ➕ ADD SLOT (SAFE VERSION)
========================= */
function addSlot(day) {
    const container = document.querySelector(`[data-day="${day}"] .slots`);

    const key = 'slot_' + Date.now() + '_' + Math.floor(Math.random() * 1000);

    const slot = document.createElement('div');
    slot.className = "d-flex gap-2 mb-2 slot align-items-center";

    slot.innerHTML = `
        <input type="time"
               class="form-control form-control-sm"
               name="days[${day}][slots][${key}][start]">

        <span>←</span>

        <input type="time"
               class="form-control form-control-sm"
               name="days[${day}][slots][${key}][end]">

        <button type="button"
                class="btn btn-sm btn-danger"
                onclick="removeSlot(this)">
            ✕
        </button>
    `;

    container.appendChild(slot);
}


/* =========================
   ❌ REMOVE SLOT (SMOOTH UX)
========================= */
function removeSlot(btn) {
    const el = btn.closest('.slot');

    el.style.transition = "all .2s ease";
    el.style.opacity = "0";
    el.style.transform = "scale(0.95)";

    setTimeout(() => el.remove(), 150);
}


/* =========================
   📋 COPY DAY 0 TO ALL DAYS
========================= */
function copyToAllDays() {

    const source = document.querySelector('[data-day="0"] .slots');

    document.querySelectorAll('.day-block').forEach((block, index) => {
        if (index === 0) return;

        const target = block.querySelector('.slots');
        target.innerHTML = "";

        source.querySelectorAll('.slot').forEach(slot => {

            const start = slot.querySelector('input[type="time"]:first-child')?.value;
            const end = slot.querySelector('input[type="time"]:nth-child(3)')?.value;

            if (!start || !end) return;

            const key = 'slot_' + Date.now() + Math.random();

            target.insertAdjacentHTML('beforeend', `
                <div class="d-flex gap-2 mb-2 slot align-items-center">

                    <input type="time"
                           class="form-control form-control-sm"
                           name="days[${index}][slots][${key}][start]"
                           value="${start}">

                    <span>←</span>

                    <input type="time"
                           class="form-control form-control-sm"
                           name="days[${index}][slots][${key}][end]"
                           value="${end}">

                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="removeSlot(this)">
                        ✕
                    </button>

                </div>
            `);
        });
    });
}


/* =========================
   🚫 TOGGLE DAY (UX SMOOTH)
========================= */
document.querySelectorAll('.toggle-day').forEach(cb => {
    applyToggle(cb);

    cb.addEventListener('change', function () {
        applyToggle(this);
    });
});

function applyToggle(checkbox) {
    const block = checkbox.closest('.day-block');
    const slots = block.querySelector('.slots');
    const btn = block.querySelector('button.btn-outline-primary');

    if (checkbox.checked) {
        slots.style.opacity = "0.4";
        slots.style.pointerEvents = "none";
        slots.style.maxHeight = "0px";
        slots.style.overflow = "hidden";

        if (btn) btn.disabled = true;

    } else {
        slots.style.opacity = "1";
        slots.style.pointerEvents = "auto";
        slots.style.maxHeight = "1000px";
        slots.style.overflow = "visible";

        if (btn) btn.disabled = false;

        // auto slot لو فاضي
        if (slots.children.length === 0) {
            addSlot(block.dataset.day);
        }
    }
}

</script>
@endsection