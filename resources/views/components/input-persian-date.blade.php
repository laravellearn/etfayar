<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <label>{{$title}} : </label>
        </div>
        <div class="col-md-9">
            <div class="position-relative has-icon-left">
                <input type="{{$type}}" class="form-control" name="{{$name}}" id="{{$id}}" placeholder="{{$title}}"
                       value="{{$value}}">
                <div class="form-control-position">
                    <i class="{{$icon}}"></i>
                </div>
            </div>
        </div>


    </div>

    <script>
        window.onload = function () {


        }

        var $j =  jQuery.noConflict();


        $j("#{{$id}}").MdPersianDateTimePicker({
            targetTextSelector: "#{{$id}}",
            targetDateSelector: '#inputHiddenDate1',
            englishNumber: true,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            modalMode: false


        });
        console.log("id is:" + {{"$id"}})
    </script>

</div>
