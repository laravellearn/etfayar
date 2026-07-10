<div id="transport_question_block" class="col-lg-12">


    @php($title=__("preinvoice.visit_date"))
    @php($caption='')
    @php($value=$transport->persianVisitDate??'')
    <x-InputRow :title="$title" name="visit_date" id="visit_date" :value="$value" :caption="$caption" type="text"
                icon="bx bx-calendar">
    </x-InputRow>


    @php($title=__("preinvoice.visit_time"))
    @php($caption='')
    @php($value=$transport->visit_time??'')
    <x-InputRow dir="ltr" :title="$title" name="visit_time" id="visit_time" :value="$value" :caption="$caption" type="text"
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
</div>
