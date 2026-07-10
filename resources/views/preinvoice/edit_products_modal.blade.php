{{-- resources/views/preinvoice/edit_products_modal.blade.php --}}
<div class="modal fade" id="editProductModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش محصولات / خدمات / تست</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body p-4">

                <div class="form-group">
                    <input type="text" class="form-control search-row" placeholder="جستجو بر اساس عنوان ...">
                </div>

                <ul class="nav nav-tabs mb-4" id="editProductServiceTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#editProductPane" role="tab">محصول</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#editServicePane" role="tab">خدمت</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#editTestPane" role="tab">تست</a>
                    </li>
                </ul>

                <div class="tab-content">
                    @php
                        if (isset($products) && !isset($services)) {
                            $allProd  = $products->where('type', 'product')->sortBy('code');
                            $allServ  = $products->where('type', 'service')->sortBy('code');
                            $allTest  = $products->where('type', 'test')->sortBy('code');
                        } else {
                            $allProd = ($products ?? collect())->sortBy('code');
                            $allServ = ($services ?? collect())->sortBy('code');
                            $allTest = ($tests ?? collect())->sortBy('code');
                        }
                    @endphp

                    <!-- محصولات -->
                    <div class="tab-pane fade show active" id="editProductPane" role="tabpanel">
                        <table class="table table-bordered table-head-custom datatable-head-bg text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('product.name')</th>
                                    <th>@lang('product.code')</th>
                                    <th>@lang('product.exist_products_quantity')</th>
                                    <th>@lang('product.quantity')</th>
                                    <th>@lang('product.price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allProd as $item)
                                @php
                                    $storedItem = collect($single->items)->firstWhere('product_id', $item->id);
                                    $storedCount = $storedItem['count'] ?? 0;
                                    $storedPrice = $storedItem['price'] ?? $item->price;
                                @endphp
                                <tr>
                                    <td><span class="label label-light-danger label-inline mr-3 ml-2 mt-3">{{$loop->iteration}}</span></td>
                                    <td class="title search-title" data-title="{{$item->title}}" data-id="{{$item->id}}" style="width: 250px!important;">{{$item->title}}</td>
                                    <td>{{$item->code}}</td>
                                    <td><span class="label label-light-primary label-inline mr-3 ml-2 mt-3"><strong>&nbsp;{{$item->quantity}}&nbsp;</strong> عدد</span></td>
                                    <td style="width: 150px!important;">
                                        <input type="number" name="count" class="form-control count" min="0"
                                               value="{{ $storedCount }}"
                                               placeholder="@lang('preinvoice.count')">
                                    </td>
                                    <td>
                                        <input type="text" name="price" class="form-control price-formatted price"
                                               value="{{ number_format($storedPrice) }}"
                                               data-original-price="{{ $item->price }}">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted">هیچ محصولی یافت نشد.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- خدمات -->
                    <div class="tab-pane fade" id="editServicePane" role="tabpanel">
                        <table class="table table-bordered table-head-custom datatable-head-bg text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('product.name')</th>
                                    <th>@lang('product.code')</th>
                                    <th>@lang('product.exist_products_quantity')</th>
                                    <th>@lang('product.quantity')</th>
                                    <th>@lang('product.price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allServ as $item)
                                @php
                                    $storedItem = collect($single->items)->firstWhere('product_id', $item->id);
                                    $storedCount = $storedItem['count'] ?? 0;
                                    $storedPrice = $storedItem['price'] ?? $item->price;
                                @endphp
                                <tr>
                                    <td><span class="label label-light-danger label-inline mr-3 ml-2 mt-3">{{$loop->iteration}}</span></td>
                                    <td class="title search-title" data-title="{{$item->title}}" data-id="{{$item->id}}" style="width: 250px!important;">{{$item->title}}</td>
                                    <td>{{$item->code}}</td>
                                    <td><span class="label label-light-primary label-inline mr-3 ml-2 mt-3"><strong>&nbsp;{{$item->quantity}}&nbsp;</strong> عدد</span></td>
                                    <td style="width: 150px!important;">
                                        <input type="number" name="count" class="form-control count" min="0"
                                               value="{{ $storedCount }}"
                                               placeholder="@lang('preinvoice.count')">
                                    </td>
                                    <td>
                                        <input type="text" name="price" class="form-control price-formatted price"
                                               value="{{ number_format($storedPrice) }}"
                                               data-original-price="{{ $item->price }}">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted">هیچ خدمتی یافت نشد.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- تست (جدید) -->
                    <div class="tab-pane fade" id="editTestPane" role="tabpanel">
                        <table class="table table-bordered table-head-custom datatable-head-bg text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('product.name')</th>
                                    <th>@lang('product.code')</th>
                                    <th>@lang('product.exist_products_quantity')</th>
                                    <th>@lang('product.quantity')</th>
                                    <th>@lang('product.price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allTest as $item)
                                @php
                                    $storedItem = collect($single->items)->firstWhere('product_id', $item->id);
                                    $storedCount = $storedItem['count'] ?? 0;
                                    $storedPrice = $storedItem['price'] ?? $item->price;
                                @endphp
                                <tr>
                                    <td><span class="label label-light-danger label-inline mr-3 ml-2 mt-3">{{$loop->iteration}}</span></td>
                                    <td class="title search-title" data-title="{{$item->title}}" data-id="{{$item->id}}" style="width: 250px!important;">{{$item->title}}</td>
                                    <td>{{$item->code}}</td>
                                    <td><span class="label label-light-primary label-inline mr-3 ml-2 mt-3"><strong>&nbsp;{{$item->quantity}}&nbsp;</strong> عدد</span></td>
                                    <td style="width: 150px!important;">
                                        <input type="number" name="count" class="form-control count" min="0"
                                               value="{{ $storedCount }}"
                                               placeholder="@lang('preinvoice.count')">
                                    </td>
                                    <td>
                                        <input type="text" name="price" class="form-control price-formatted price"
                                               value="{{ number_format($storedPrice) }}"
                                               data-original-price="{{ $item->price }}">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted">هیچ مورد تستی یافت نشد.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">انصراف</button>
                <button id="editProductButton" type="button" class="btn btn-primary font-weight-bold">ذخیره تغییرات</button>
            </div>
        </div>
    </div>
</div>

<script>
    if (typeof formatPrice === 'undefined') {
        function formatPrice(price) { return String(price).replace(/\B(?=(\d{3})+(?!\d))/g, ","); }
    }
    if (typeof unformatPrice === 'undefined') {
        function unformatPrice(val) { return String(val).replace(/,/g, ''); }
    }

    $('#editProductModal .search-row').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        var activePane = $('#editProductModal .tab-pane.active');
        if (activePane.length) {
            activePane.find('tbody tr').filter(function() {
                $(this).toggle($(this).find('.search-title').text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    $(document).on('focus', '#editProductModal .price-formatted', function() {
        $(this).val(unformatPrice($(this).val()));
    }).on('blur', '#editProductModal .price-formatted', function() {
        var num = unformatPrice($(this).val());
        if ($.isNumeric(num)) {
            $(this).val(formatPrice(num));
        } else {
            $(this).val(formatPrice($(this).data('original-price')));
        }
    });
</script>