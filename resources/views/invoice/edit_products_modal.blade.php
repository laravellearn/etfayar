<div class="modal fade" id="addProductModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticdrop" aria-hidden="true">
    <div style="" class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش محصولات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


            <style>

                table.dataTable td {
                    font-size: 0.4em;
                }

                th {
                    font-size: 10px !important;
                    padding: 7px !important;
                }

                td {
                    font-size: 12px !important;
                    padding: 3px !important;
                }

                td div {
                    font-size: 10px !important;
                    /*padding: 5px!important;*/
                }


            </style>
            <div class="modal-body p-4">
                <!--begin: جدول داده ها-->
                <table class="table table-bordered table-head-custom datatable-head-bg text-center"
                       id="kt_datatable_choose_products">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-black">@lang('product.name')</th>
                        <th class="text-black">@lang('product.code')</th>
                        <th class="text-black">@lang('product.exist_products_quantity')</th>
                        <th class="text-black">@lang('product.quantity')</th>
                        <th class="text-black">@lang('product.price')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $item)
                        <tr>
                            <td><span
                                    class="label label-light-danger label-inline mr-3 ml-2 mt-3">{{$loop->iteration}}</span>
                            </td>
                            <td class="title" data-title="{{$item->title}}" data-id="{{$item->id}}"
                                style="width: 250px!important;"> {{$item->title}} </td>
                            <td>{{$item->code}}</td>
                            <td>
                                <span class="label label-light-primary label-inline mr-3 ml-2 mt-3"> <strong>&nbsp;{{$item->quantity}}&nbsp;</strong>  عدد  </span>
                            </td>

                            <td style="width: 150px!important;" colspan="1" class="justify-content-center">
                                <input type="number" name="count" id="count"
                                       class="form-control count"
                                       {{--onkeyup=enforceMinMax(this)--}}
                                       min="0"
                                       @if(in_array($item->id,collect($single->items->toArray())->pluck('product_id')->toArray()))
                                           value="{{ collect($single->items->toArray())->where('preinvoice_id', '=',$single->id)->firstWhere('product_id', '=',$item->id)['count']  }}"
                                       {{-- max="{{ collect($single->items->toArray())->where('preinvoice_id', '=',$single->id)->firstWhere('product_id', '=',$item->id)['count']+ $item->quantity }}"--}}

                                       @else
                                           {{--max="{{$item->quantity}}"--}}
                                       @endif

                                       placeholder="@lang('preinvoice.count')"></td>
                            <td>
                                {{-- {{number_format($item->price)}}--}}
                                <input type="number" name="price" id="price"
                                       class="form-control price"
                                       min="0"
                                       @if(in_array($item->id,collect($single->items->toArray())->pluck('product_id')->toArray()))
                                           value="{{ collect($single->items->toArray())->where('preinvoice_id', '=',$single->id)->firstWhere('product_id', '=',$item->id)['price']  }}"

                                       @else
                                           value="{{$item->price}}"
                                    @endif
                                >

                            </td>

                        </tr>

                    @endforeach
                    </tbody>

                </table>
                <!--end: جدول داده ها-->

            </div>
            <div class="modal-footer">
                <button id="cancelModalButton" type="button"
                        class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">انصراف
                </button>
                <button id="addProductButton" type="button"
                        class="btn btn-primary font-weight-bold">افزودن محصولات انتخاب شده
                </button>
            </div>
        </div>
    </div>
</div>
