<script>
    $(document).ready(function() {
        load_cart();
    });
    $(window).scroll(function() {
        checkScroll()
    });
    var menu = $("#main-menu");
    var sticky = menu.offset().top + 100;

    function checkScroll() {
        if (window.pageYOffset >= sticky) {
            menu.addClass("sticky")
        } else {
            menu.removeClass("sticky");
        }
        // if ($('#loading').hasClass('open') || $('#cart').hasClass('open')) {
        //     // $("body").css({"position": "static", "overflow": "auto"});
        //     $("body").css({"position": "sticky", "overflow": "hidden"});
        // } else {
        //     // $("body").css({"position": "sticky", "overflow": "hidden"});
        //     $("body").css({"position": "static", "overflow": "auto"});
        // }
    }
    $(window).click(function(e) {
        if (e.target.className == 'ws-container' || e.target.className == 'close-modal') {
            $('.ws-over').removeClass('open');
            $('.ws-over').addClass('close');
        }
    });
    let _token = $('meta[name="csrf-token"]').attr('content');
    $('.wish').click(function() {
        let _this = $(this);
        let id = $(this).data('id');
        if (_this.find('.noloading').hasClass('active') && _this.hasClass('active')) {
            loading_add_wish(_this)
            $.ajax({
                url: "{{ route('remove-wish') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                },
                success: function(data) {
                    loading_add_wish(_this, false)
                    if (data.wish !== 'undefined') {
                        count_wish(data.wish);
                    }
                    if (data.status == 1) {
                        _this.removeClass('active');
                        toastr.clear();
                        toastr.success(data.msg);
                    } else if (data.status == 0) {
                        toastr.clear();
                        toastr.error(data.msg);
                    } else {
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }

                },
                error: function(data) {
                    loading_add_wish(_this)
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            });
        } else {
            loading_add_wish(_this)
            $.ajax({
                url: "{{ route('add-wish') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                },
                success: function(data) {
                    loading_add_wish(_this, true)
                    if (data.wish !== 'undefined') {
                        count_wish(data.wish);
                    }
                    if (data.status == 1) {
                        _this.addClass('active');
                        toastr.clear();
                        toastr.success(data.msg);
                    } else if (data.status == 0) {
                        toastr.clear();
                        toastr.error(data.msg);
                    } else {
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }

                },
                error: function(data) {
                    loading_add_wish(_this)
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            });
        }
    })
    $('#add_to_wish').click(function() {
        let _this = $(this);
        let id = $(this).data('id');
        if (!_this.find('.onloading').hasClass('active')) {
            _this.find('.onloading').addClass('active')
            if (_this.hasClass('active')) {
                $.ajax({
                    url: "{{ route('remove-wish') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                    },
                    success: function(data) {
                        _this.find('.onloading').removeClass('active')
                        if (data.wish !== 'undefined') {
                            count_wish(data.wish);
                        }
                        if (data.status == 1) {
                            _this.removeClass('active');
                            toastr.clear();
                            toastr.success(data.msg);
                        } else if (data.status == 0) {
                            toastr.clear();
                            toastr.error(data.msg);
                        } else {
                            toastr.clear();
                            toastr.error('{{ trans('page.has_error') }}');
                        }

                    },
                    error: function(data) {
                        _this.find('.onloading').removeClass('active')
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('add-wish') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                    },
                    success: function(data) {
                        _this.find('.onloading').removeClass('active')
                        if (data.wish !== 'undefined') {
                            count_wish(data.wish);
                        }
                        if (data.status == 1) {
                            _this.addClass('active');
                            toastr.clear();
                            toastr.success(data.msg);
                        } else if (data.status == 0) {
                            toastr.clear();
                            toastr.error(data.msg);
                        } else {
                            toastr.clear();
                            toastr.error('{{ trans('page.has_error') }}');
                        }

                    },
                    error: function(data) {
                        _this.find('.onloading').removeClass('active')
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }
                });
            }
        }
    })
    $('.add-to-cart').click(function() {
        let _this = $(this);
        let id = $(this).data('id');

        if (_this.find('.noloading').hasClass('active')) {
            loading_add_cart(_this)
            $.ajax({
                url: "{{ route('add-cart') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                },
                success: function(data) {
                    loading_add_cart(_this)
                    load_cart();
                    if (data.cart !== 'undefined') {
                        count_cart(data.cart)
                    }
                    if (data.status == 1) {
                        // $("#cart").css('display', 'block');
                        // _this.addClass('active');
                        toastr.clear();
                        toastr.success(data.msg);
                    } else if (data.status == 0) {
                        toastr.clear();
                        toastr.error(data.msg);
                    } else {
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }

                },
                error: function(data) {
                    loading_add_cart(_this)
                    load_cart()
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            });
        }

    });
    $('#add_to_cart').click(function() {
        let _this = $(this);
        let id = $(this).data('id');
        let qty = $('#quantity').val();
        if (!_this.find('.onloading').hasClass('active')) {
            _this.find('.onloading').addClass('active');
            $.ajax({
                url: "{{ route('add-cart') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                    quantity: qty
                },
                success: function(data) {
                    _this.find('.onloading').removeClass('active');
                    load_cart();
                    if (data.cart !== 'undefined') {
                        count_cart(data.cart)
                    }
                    if (data.status == 1) {
                        toastr.clear();
                        toastr.success(data.msg);
                    } else if (data.status == 0) {
                        toastr.clear();
                        toastr.error(data.msg);
                    } else {
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }

                },
                error: function(data) {
                    _this.find('.onloading').removeClass('active');
                    load_cart()
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            });
        }

    });
    $('.remove_product').click(function() {
        let _this = $(this);
        let id = $(this).data('id');
        if (!_this.find('.onloading').hasClass('active') && id > 0) {
            _this.parent().find('.onloading').addClass('active');
            $.ajax({
                url: "{{ route('remove-product-cart') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                },
                success: function(data) {
                    _this.parent().find('.onloading').removeClass('active');
                    load_cart();
                    if (data.cart !== 'undefined') {
                        count_cart(data.cart)
                    }
                    if (data.status == 1) {
                        _this.parent().parent().remove();
                        toastr.clear();
                        toastr.success(data.msg);
                    } else if (data.status == 0) {
                        toastr.clear();
                        toastr.error(data.msg);
                    } else {
                        toastr.clear();
                        toastr.error('{{ trans('page.has_error') }}');
                    }

                },
                error: function(data) {
                    _this.parent().find('.onloading').removeClass('active');
                    load_cart()
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            });
        }

    });
    $('.my-cart').click(function() {
        $('#cart').removeClass('close');
        $('#cart').addClass('open');
        if ($('#cart-content').children().length == 0) {
            toggle_loading($('#cart').find('.ws-loading'));
            load_cart();
            toggle_loading($('#cart').find('.ws-loading'));
        }

    });
    $('.my-cart1').click(function() {
        $('#vnp').removeClass('close');
        $('#vnp').addClass('open');
        // if ($('#cart-content').children().length == 0) {
        //     // toggle_loading($('#vnp').find('.ws-loading'));
        //     // // load_cart();
        //     // toggle_loading($('#vnp').find('.ws-loading'));
        // }

    });

    function load_cart() {
        $.ajax({
            url: "{{ route('get-cart') }}",
            type: "POST",
            data: {
                _token: _token,
            },
            success: function(data) {
                if (data.status == 1) {
                    if (data.sub_total !== 'undefined') {
                        $('.sum__cart').html(new Intl.NumberFormat('vi-VI', {
                            maximumSignificantDigits: 3
                        }).format(data.sub_total));
                    }
                    if (data.html !== 'undefined') {
                        $('#cart-content').html(data.html);
                    }
                } else {
                    toastr.clear();
                    toastr.error('{{ trans('page.has_error') }}');
                }
            },
            error: function(data) {
                toastr.clear();
                toastr.error('{{ trans('page.has_error') }}');
            }
        });
    }

    function loading_add_cart(_this) {
        if (_this.find('.noloading').hasClass('active')) {
            _this.addClass('active')
            _this.find('.noloading').removeClass('active');
            _this.find('.onloading').addClass('active');
        } else {
            _this.removeClass('active')
            _this.find('.onloading').removeClass('active');
            _this.find('.noloading').addClass('active');
        }
    }

    function loading_add_wish(_this, _status) {
        if (_this.find('.noloading').hasClass('active')) {
            _this.addClass('active')
            _this.find('.noloading').removeClass('active');
            _this.find('.onloading').addClass('active');
        } else {
            _this.find('.onloading').removeClass('active');
            _this.find('.noloading').addClass('active');
        }
        if (_status !== null) {
            if (_status == true) {
                _this.addClass('active')
            } else {
                _this.removeClass('active')
            }
        }
    }

    function count_cart(num) {
        $('.count_cart').each(function(value, index) {
            $(this).text(num);
        });
    }

    function count_wish(num) {
        $('.count_wish').each(function(value, index) {
            $(this).text(num);
        });
    }

    function toggle_loading(_this) {
        console.log(_this)
        if ($(_this).hasClass('open')) {
            $(_this).removeClass('open');
            $(_this).addClass('close');
        } else if ($(_this).hasClass('close')) {
            $(_this).removeClass('close');
            $(_this).addClass('open');
        }
    }
    $('.qtybtn').click(function() {
        toastr.clear();
        var _this = $(this);
        if (!_this.parent().parent().find('.onloading').hasClass('active')) {
            var id = _this.parent().data('id-cart');
            if (id) {
                var route = '';
                if (_this.hasClass('inc')) {
                    route = "{{ route('inc-quantity') }}";
                }
                if (_this.hasClass('dec')) {
                    route = "{{ route('dec-quantity') }}";
                }
                var qty = _this.parent().find('input').val();
                if (route !== '') {
                    _this.parent().parent().find('.onloading').addClass('active');
                    $.ajax({
                        url: route,
                        type: "POST",
                        data: {
                            _token: _token,
                            id: id,
                            quantity: qty
                        },
                        success: function(data) {
                            _this.parent().parent().find('.onloading').removeClass('active')
                            if (data.status == 1) {
                                load_cart();
                                if (data.total !== 'undefined') {
                                    var cr = '' + new Intl.NumberFormat('vi-VI', {
                                        maximumSignificantDigits: 3
                                    }).format(data.total) + ' {{ trans('page.currency') }}';
                                    _this.parent().parent().parent().parent().find(
                                        '.shoping__cart__total').html(cr);
                                }
                                if (data.quantity !== 'undefined') {
                                    _this.parent().find('input').val(data.quantity);
                                }
                                if (data.msg) {
                                    toastr.clear();
                                    toastr.warning(data.msg);
                                }
                                if (data.sub_total !== 'undefined') {
                                    $('.sum__cart').html(new Intl.NumberFormat('vi-VI', {
                                        maximumSignificantDigits: 3
                                    }).format(data.sub_total));
                                }
                            } else {
                                toastr.clear();
                                toastr.error('{{ trans('page.has_error') }}');
                            }
                        },
                        error: function(data) {
                            _this.parent().parent().find('.onloading').removeClass('active')
                            toastr.clear();
                            toastr.error('{{ trans('page.has_error') }}');
                        }
                    });
                }
            }
            //
        }
    });
</script>
