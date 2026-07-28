@extends('layout.main')@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">{{ $title }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <x-Button permission="Access Ledger" :title="__('ledger.title')" url="{{ route('ledger.index') }}">
                            </x-Button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-separate table-head-custom">
                                <thead>
                                    <tr>
                                        <th>@lang('ledger.customer')</th>
                                        <th>@lang('payment.bank')</th>
                                        <th>@lang('payment.price')</th>
                                        <th>@lang('payment.description')</th>
                                        <th>@lang('ledger.submitted_by')</th>
                                        <th>@lang('common.created_at')</th>
                                        <th>@lang('common.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($list as $item)
                                        <tr>
                                            <td nowrap>
                                                {{$item->preinvoice->request->user->full_name??''}}
                                            </td>
                                            <td>{{ $item->bank->name ?? '' }}</td>
                                            <td nowrap>{{ number_format($item->price, 0, '.', ',') }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td nowrap>{{ $item->admin->full_name ?? '' }}</td>
                                            <td nowrap>{{ $item->persianDateTime }}</td>
                                            <td nowrap>
                                                <x-FormButton permission="Agree Payment" url="javascript:;"
                                                    :icon="__('icon.agree_icon')" :title="__('payment.is_agree')"
                                                    click="changeDialog('{{ __('payment.agree_payment') }}','{{ __('payment.are_you_sure_to_agree') }}','/admin/payment/agree_payment/{{ $item->id }}')"></x-FormButton>

                                                <x-FormButton permission="DisAgree Payment" url="javascript:;"
                                                    :icon="__('icon.disagree_icon')" :title="__('payment.disagree')" type="danger"
                                                    click="changeDialog('{{ __('payment.disagree_payment') }}','{{ __('payment.are_you_sure_to_disagree') }}','/admin/payment/disagree_payment/{{ $item->id }}')"></x-FormButton>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('ledger.no_records')</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
