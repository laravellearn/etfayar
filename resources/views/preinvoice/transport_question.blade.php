<div id="transport_question_block" class="col-lg-12">


    @php($title=__("preinvoice.visit_date"))
    @php($caption='')
    @php($value=$transport->persianVisitDate??'')
    <x-InputRow :title="$title" name="visit_date" id="visit_date" :value="$value" :caption="$caption" type="text"
                icon="bx bx-calendar">
    </x-InputRow>


    @php($title=__("preinvoice.visit_time_from_1"))
    @php($caption='')
    @php($value=$transport->visit_time_from_1??'')
    <x-InputRow dir="ltr" :title="$title" name="visit_time_from_1" id="visit_time_from_1" :value="$value" :caption="$caption" type="time"
                :step="300"
                icon="bx bx-time">
    </x-InputRow>

    @php($title=__("preinvoice.visit_time_to_1"))
    @php($caption='')
    @php($value=$transport->visit_time_to_1??'')
    <x-InputRow dir="ltr" :title="$title" name="visit_time_to_1" id="visit_time_to_1" :value="$value" :caption="$caption" type="time"
                :step="300"
                icon="bx bx-time">
    </x-InputRow>

    @php($title=__("preinvoice.visit_time_from_2"))
    @php($caption='')
    @php($value=$transport->visit_time_from_2??'')
    <x-InputRow dir="ltr" :title="$title" name="visit_time_from_2" id="visit_time_from_2" :value="$value" :caption="$caption" type="time"
                :step="300"
                icon="bx bx-time">
    </x-InputRow>

    @php($title=__("preinvoice.visit_time_to_2"))
    @php($caption='')
    @php($value=$transport->visit_time_to_2??'')
    <x-InputRow dir="ltr" :title="$title" name="visit_time_to_2" id="visit_time_to_2" :value="$value" :caption="$caption" type="time"
                :step="300"
                icon="bx bx-time">
    </x-InputRow>



    @php($title=__("preinvoice.delivery_duration"))
    @php($caption='')
    @php($value=$transport->delivery_duration??'')
    <x-InputRow :title="$title" name="delivery_duration" id="delivery_duration" :value="$value" :caption="$caption"
                type="number"
                icon="bx bx-duration">
    </x-InputRow>

    @php($title=__("preinvoice.additional_description"))
    @php($caption=__(""))
    @php($value=$transport->description??'')
    <x-InputText :title="$title" name="additional_description" id="additional_description" :value="$value"
                 :caption="$caption"
                 type="text" icon="bx bx-text">
    </x-InputText>

    <div class="form-group row">
        <label class="col-3">@lang('preinvoice.is_fiduciary')</label>
        <div class="radio-inline">

            @if(isset($transport))

                @if($transport->is_fiduciary==0)
                    <label class="radio radio-lg">
                        <input type="radio" value="0" checked="checked" name="is_fiduciary"/>
                        <span></span> خیر </label>

                    <label class="radio radio-lg">
                        <input type="radio" value="1" name="is_fiduciary"/>
                        <span></span> بله </label>
                @else
                    <label class="radio radio-lg">
                        <input type="radio" value="0" name="is_fiduciary"/>
                        <span></span> خیر </label>

                    <label class="radio radio-lg">
                        <input type="radio" value="1" checked="checked" name="is_fiduciary"/>
                        <span></span> بله </label>
                @endif
            @else
                <label class="radio radio-lg">
                    <input type="radio" value="0" checked="checked" name="is_fiduciary"/>
                    <span></span> خیر </label>

                <label class="radio radio-lg">
                    <input type="radio" value="1" name="is_fiduciary"/>
                    <span></span> بله </label>
            @endif


        </div>

    </div>
    <script>
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: true
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , pastYearsCount: 0
            , futureYearsCount: 3
            , markToday: true
            , markHolidays: false
            , highlightSelectedDay: false
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('visit_date', customOptions);
    </script>

    {{-- انتخاب ساعت به‌صورت ۲۴ ساعته (00 تا 23) و دقیقه با گام ۵ دقیقه‌ای (بدون AM/PM) --}}
    <script>
        (function () {
            var ids = ['visit_time_from_1', 'visit_time_to_1', 'visit_time_from_2', 'visit_time_to_2'];

            function pad(n) {
                return ('0' + n).slice(-2);
            }

            function buildSelect(options, selected) {
                var sel = document.createElement('select');
                sel.className = 'form-control';
                sel.style.width = '110px';
                options.forEach(function (o) {
                    var opt = document.createElement('option');
                    opt.value = o.value;
                    opt.textContent = o.label;
                    if (o.value === selected) {
                        opt.selected = true;
                    }
                    sel.appendChild(opt);
                });
                return sel;
            }

            ids.forEach(function (id) {
                var input = document.getElementById(id);
                if (!input) {
                    return;
                }

                var m = /^(\d{1,2}):(\d{2})/.exec((input.value || '').trim());
                var curH = m ? pad(parseInt(m[1], 10)) : '';
                var curM = m ? m[2] : '00';

                var hours = [{value: '', label: '--'}];
                for (var h = 0; h < 24; h++) {
                    hours.push({value: pad(h), label: pad(h)});
                }

                var minutes = [];
                var hasCur = false;
                for (var mi = 0; mi < 60; mi += 5) {
                    minutes.push({value: pad(mi), label: pad(mi)});
                    if (pad(mi) === curM) {
                        hasCur = true;
                    }
                }
                // اگر مقدار ذخیره‌شده‌ی قبلی مضرب ۵ نبود، برای اینکه اطلاعات قدیمی تغییر نکند به لیست اضافه می‌شود
                if (!hasCur) {
                    minutes.push({value: curM, label: curM});
                    minutes.sort(function (a, b) {
                        return parseInt(a.value, 10) - parseInt(b.value, 10);
                    });
                }

                var hourSel = buildSelect(hours, curH);
                var minSel = buildSelect(minutes, curM);

                var wrap = document.createElement('div');
                wrap.style.display = 'flex';
                wrap.style.alignItems = 'center';
                wrap.style.direction = 'ltr';
                wrap.style.gap = '8px';

                var sep = document.createElement('span');
                sep.textContent = ':';
                sep.style.fontWeight = 'bold';

                wrap.appendChild(hourSel);
                wrap.appendChild(sep);
                wrap.appendChild(minSel);

                function sync() {
                    input.value = hourSel.value === '' ? '' : (hourSel.value + ':' + minSel.value);
                }

                hourSel.addEventListener('change', sync);
                minSel.addEventListener('change', sync);

                // input اصلی (با همان name) مخفی می‌ماند و مقدار HH:MM را همراه فرم ارسال می‌کند
                input.type = 'hidden';
                input.parentNode.insertBefore(wrap, input);
                sync();
            });
        })();
    </script>
</div>
