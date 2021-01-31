$(function () {

    $(".business").click(function() {
        $('html, body').animate({
            scrollTop: $("#business").offset().top - 90
        }, 500);

        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".reason").click(function() {
        $('html, body').animate({
            scrollTop: $("#reason").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });

    $(".performance").click(function() {
        $('html, body').animate({
            scrollTop: $("#performance").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".message").click(function() {
        $('html, body').animate({
            scrollTop: $("#message").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".flow").click(function() {
        $('html, body').animate({
            scrollTop: $("#flow").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".question").click(function() {
        $('html, body').animate({
            scrollTop: $("#question").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".contact").click(function() {
        $('html, body').animate({
            scrollTop: $("#contact").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });
    $(".company").click(function() {
        $('html, body').animate({
            scrollTop: $("#company").offset().top - 90
        }, 500);
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
    });

    $('#contact_info img').on('click', function() {
        $('.overlay')
            .css({backgroundImage: `url('${this.src}')`})
            .addClass('open')
            .one('click', function() {
                $(this).removeClass('open').css({backgroundImage: ''});
            });
    });

    $('.btn-send-contact').click(function () {
        var name = $('.name').val();
        var email = $('.email').val();
        var company_type = $('.company_type').val();
        var content_email = $('.content_email').val();
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: 'POST',
            async: true,
            dataType: 'json',
            data: {
                'name': name,
                'email' : email,
                'company_type' : company_type,
                'content_email' : content_email,
            },
            success: function (result) {

                if(result.message) {
                    $('.message-send-mail-success').html(result.message);
                } else {
                    $('.message-send-mail-success').html('')
                }

                $('.name').val('');
                $('.email').val('');
                $('.content_email').val('');
                $('.text-danger-name').html('');
                $('.text-danger-email').html('');
            },
            error: function (xhr) {
                if(xhr.responseJSON.errors.name == undefined) {
                    $('.text-danger-name').html('');
                } else {
                    $('.text-danger-name').html(xhr.responseJSON.errors.name)
                }
                $('.text-danger-email').html(xhr.responseJSON.errors.email)
            }
        });

    })

    $('.classy-menu .classynav a').click(function(){
        $('.classy-menu').removeClass('menu-on');
        $('.navbarToggler').removeClass('active');
    });

    $(document).on('click', '.add-to-cart-button button', function (e) {
        e.preventDefault();
        let productId = $(this).data('product-id');
        addToCart(productId);
    });

    $('.change_quantity').on("input", function(){
        let quantity = $(this).val();
        if (quantity === '') {
            return false;
        }
        let idProduct = $(this).attr('data-id')
        changeQuantity(idProduct, quantity);
    });
});

function deleteCart(idProduct) {
    $.ajax({
        url: routes.delete_product,
        type: 'POST',
        async: true,
        dataType: 'json',
        data: {
            'id': idProduct,
        },
        success: function (result) {
            if (result.msg !== '') {
                $('.list-cart').html('<p>' + result.msg + '</p>');
            } else {
                $('.product_' + idProduct).remove();
                $('#totalAll').html(result.totalAll + '<span>₫</span>');
            }
        },
        error: function (xhr) {
        }
    });
}

function addToCart(productId, quantity = 1) {
    $.ajax({
        url: add_to_cart,
        method: 'POST',
        data: {
            product_id: productId,
            quantity: quantity,
        },
        success: function (response) {
            toastr.success(response.message);
            $('span.cart-price').text(response.cartQuantity);
        },
        error: function (error) {
            toastr.error('Thêm sản phầm không thành công');
        },
    });
}

function  changeQuantity(idProduct, quantity) {
    $.ajax({
        url: routes.change_quantity,
        type: 'POST',
        async: true,
        dataType: 'json',
        data: {
            'id': idProduct,
            'quantity': quantity,
        },
        success: function (result) {
            if (result.msg !== '') {
                $('.list-cart').html('<p>' + result.msg + '</p>');
            } else {
                $.each(result.arrData, function (key, item) {
                    $('.price_' + item.product.id).html(item.total.format() + '<span>₫</span>')
                });
                $('#totalAll').html(result.totalAll + '<span>₫</span>');
            }
        },
        error: function (xhr) {
        }
    });
}

function orderFastPurchase() {
    let formFastPurchase = $('.formFastPurchase');
    let data = formFastPurchase.serialize();
    $.ajax({
        url: routes.order_fast_purchase,
        type: 'POST',
        async: true,
        dataType: 'json',
        data: data,
        success: function (response) {
            $('#fastPurchase').modal('hide');
            if (response.status) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
            formFastPurchase.find('.error').html('').addClass('d-none');
            formFastPurchase.find('input').not('#form-product').val('');
        },
        error: function (res) {
            let errors = res.responseJSON.errors;
            formFastPurchase.find('.error').html('').addClass('d-none');
            for(let key in errors) {
                formFastPurchase.find('.error_' + key).html(errors[key]).removeClass('d-none');
            }
        }
    });
}

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\,' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&.');
};
