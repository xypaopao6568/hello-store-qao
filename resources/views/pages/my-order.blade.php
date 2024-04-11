@extends('pages.layouts.app')
@section('title', $title)
@section('content')
    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-page">
                        <h4>{{ $title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ trans('page.order_id') }}</th>
                                    <th>{{ trans('page.order_address') }}</th>
                                    <th>{{ trans('page.order_price') }}</th>
                                    <th>{{ trans('page.order_status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($orders) && $orders->count() > 0)
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                @if (isset($item->address) && $item->address)
                                                    {{ $item->address->address }}, {{ $item->address->ward }}
                                                    , {{ $item->address->district }}, {{ $item->address->province }}
                                                @else
                                                    <div class="text-danger">
                                                        <i>{{ trans('page.address_removed') }}</i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ number_format($item->total) }} {{ trans('page.currency') }}
                                            </td>
                                            <td>
                                                {!! trans(config('status.orders')[$item->status]) !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('show-order', ['id' => $item->id]) }}">{{ trans('page.view_order') }}</a>
                                                @if ($item->status < 2)
                                                    <div class="btn btn-sm btn-danger btn-cancel-order"
                                                        data-id="{{ $item->id }}">{{ trans('page.cancel_order') }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.layouts.sub_footer')
@endsection
@section('script')
    <script>
        $('.btn-cancel-order').click(function() {
            var _this = $(this);
            var id = _this.data('id');
            if (id) {
                Swal.fire({
                    icon: 'question',
                    title: '{{ trans('page.alert_cancel_order') }}',
                    showCancelButton: true,
                    confirmButtonText: `{{ trans('page.button_cancel_order') }}`,
                    cancelButtonText: `{{ trans('page.button_cancel') }}`,
                    confirmButtonColor: 'rgba(144,43,43,0.91)',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('cancel-order') }}',
                            type: "POST",
                            data: {
                                _token: _token,
                                id: id
                            },
                            success: function(data) {
                                if (data.status == 1) {
                                    if (data.msg) {
                                        toastr.clear();
                                        toastr.success(data.msg);
                                    }
                                } else {
                                    if (data.msg) {
                                        toastr.clear();
                                        toastr.error(data.msg);
                                    } else {
                                        toastr.clear();
                                        toastr.error('{{ trans('page.has_error') }}');
                                    }

                                }
                                location.reload();
                            },
                            error: function(data) {
                                toastr.clear();
                                toastr.error('{{ trans('page.has_error') }}');
                            }
                        });
                    }
                })

            }

        });
    </script>
@endsection
