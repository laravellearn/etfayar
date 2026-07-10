<div class="form-group row">
    <label class="col-3">@lang("user.status") <strong>*</strong></label>
    <div class="col-9">
        <select class="form-control form-control" name="status">
            <option value="null" disabled selected hidden>@lang('common.choose_status')</option>
            <option {{$status==1?'selected':""}} value="1">@lang("common.active")</option>
            <option {{$status==0?'selected':""}} value="0">@lang("common.inactive")</option>
        </select>
    </div>
</div>
