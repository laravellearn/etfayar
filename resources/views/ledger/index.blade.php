@extends('layout.main')@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">{{$title}}</h3>
                        </div>
                        <div class="card-toolbar">
                            <x-Button permission="Access Ledger"
                                      :title="__('ledger.pending_approvals')"
                                      url="{{route('ledger.pending')}}">
                            </x-Button>
                            <x-Button permission="Access Ledger"
                                      :title="__('ledger.rejected')"
                                      url="{{route('ledger.rejected')}}">
                            </x-Button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: فیلتر و جستجو-->
                        <form method="get" action="{{route('ledger.index')}}" class="form mb-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>@lang('ledger.filter')</label>
                                    <select class="form-control" name="status_filter" onchange="this.form.submit()">
                                        <option value="all" {{request('status_filter')=='all'||!request('status_filter')?'selected':''}}>@lang('ledger.status_all')</option>
                                        <option value="debtor" {{request('status_filter')=='debtor'?'selected':''}}>@lang('ledger.status_debtor')</option>
                                        <option value="creditor" {{request('status_filter')=='creditor'?'selected':''}}>@lang('ledger.status_creditor')</option>
                                        <option value="settled" {{request('status_filter')=='settled'?'selected':''}}>@lang('ledger.status_settled')</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('ledger.search')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                               value="{{request('search')}}" placeholder="@lang('ledger.search')">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end: فیلتر و جستجو-->

                        <div class="table-responsive">
                            <table class="table table-separate table-head-custom">
                                <thead>
                                <tr>
                                    <th>@lang('ledger.row')</th>
                                    <th>@lang('ledger.customer')</th>
                                    <th>@lang('ledger.bank_account')</th>
                                    <th>@lang('ledger.invoice_date')</th>
                                    <th>@lang('ledger.debtor')</th>
                                    <th>@lang('ledger.creditor')</th>
                                    <th>@lang('ledger.remaining')</th>
                                    <th>@lang('ledger.status')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rows as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td nowrap>
                                            <a href="{{$row->customer_id?route('user.show',$row->customer_id):'javascript:;'}}">
                                                {{$row->customer_name}}
                                            </a>
                                            —
                                            <a href="{{route('invoice.edit',$row->preinvoice_id)}}">{{$row->code}}</a>
                                        </td>
                                        <td nowrap>{{$row->bank_account??'-'}}</td>
                                        <td nowrap>{{$row->persian_date}}</td>
                                        <td nowrap>{{number_format($row->debit,0,'.',',')}}</td>
                                        <td nowrap>{{number_format($row->credit,0,'.',',')}}</td>
                                        <td nowrap>{{number_format($row->remaining,0,'.',',')}}</td>
                                        <td nowrap>
                                            @if($row->status=='debtor')
                                                <div class="label label-lg font-weight-bold label-light-danger label-inline">@lang('ledger.status_debtor')</div>
                                            @elseif($row->status=='creditor')
                                                <div class="label label-lg font-weight-bold label-light-info label-inline">@lang('ledger.status_creditor')</div>
                                            @else
                                                <div class="label label-lg font-weight-bold label-light-success label-inline">@lang('ledger.status_settled')</div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">@lang('ledger.no_records')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="font-weight-bolder">
                                    <td colspan="4">@lang('ledger.totals')</td>
                                    <td nowrap>{{number_format($totals->debit,0,'.',',')}}</td>
                                    <td nowrap>{{number_format($totals->credit,0,'.',',')}}</td>
                                    <td nowrap>{{number_format($totals->remaining,0,'.',',')}}</td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
