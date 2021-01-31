Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\,' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&.');
};

$(document).ready(function () {
    $("#name").autocomplete({
        minLength: 0,
        source: urlSearch.customers,
        focus: function (event, ui) {
            $("#name").val(ui.item.name);
            return false;
        },
        select: function (event, ui) {
            $("#name").val(ui.item.name).prop('readonly', true);
            $("#address").val(ui.item.address).prop('readonly', true);
            $("#phone").val(ui.item.phone).prop('readonly', true);
            $("#email").val(ui.item.email).prop('readonly', true);
            $("#customerId").val(ui.item.id);

            $('#btnEditCustomer').removeClass('invisible');
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.name + ' - ' + item.address + "<br>" + item.phone + ' - ' + item.email + "</div>")
            .appendTo(ul);
    };

    $(document).on('click', '#btnEditCustomer', function (e) {
        $("#name").prop('readonly', false);
        $("#address").prop('readonly', false);
        $("#phone").prop('readonly', false);
        $("#email").prop('readonly', false);
        $("#customerId").val('');
        $(this).addClass('invisible');
    });

    initAutocomplete($("td.name input"));
    updateTotalPrice();

    // click edit product btn
    $(document).on('click', '.btnEdit', function (e) {
        let tr = $(this).closest('tr');
        tr.find('input.id').val('');
        tr.find('input.price').val('');
        tr.find('.name input').val('');
        tr.find('.name input').prop('disabled', false);
        tr.find('.image').text('');
        tr.find('.quantity input').val('');
        tr.find('.price').text('');
    });

    // click remove product btn
    $(document).on('click', '.btnRemove', function (e) {
        let lengthTr = $(this).closest('tbody').find('tr').length;
        if (lengthTr <= 1) {
            return;
        }
        $(this).closest('tr').remove();
        updateTotalPrice();
    });

    // click add product btn
    $(document).on('click', '.btnAdd', function (e) {
        let tbody = $(this).closest('tbody').prev('tbody');
        let tr = tbody.find('tr').last();
        let index = parseInt(tr.data('index'));
        index++;

        tr = tr.clone();
        tr.attr('data-index', index);
        tr.find('.id').attr('name', 'products[' + index + '][product_id]').val('');
        tr.find('.price').attr('name', 'products[' + index + '][price]').val('');
        tr.find('td.name input').prop('disabled', false).val('');
        tr.find('td.image').text('');
        tr.find('td.quantity input').attr('name', 'products[' + index + '][quantity]').val('');
        tr.find('td.price').text('');
        tr.appendTo(tbody);

        initAutocomplete(tr.find('td.name input'));
    });

    // quantity change, keyup event
    $(document).on('change keyup', 'td.quantity input', function (e) {
        updateTotalPrice();
    });
});

function initAutocomplete(ele) {
    // autocomplete for name of products
    ele.autocomplete({
        minLength: 0,
        source: urlSearch.products,
        focus: function (event, ui) {
            $(event.target).val(ui.item.name);
            return false;
        },
        select: function (event, ui) {
            let target = $(event.target);
            let tr = target.closest('tr');

            target.val(ui.item.name);
            target.prop('disabled', true);
            tr.find('input.id').val(ui.item.id);
            tr.find('input.price').val(ui.item.price);
            tr.find('td.price').text(ui.item.price.format() + '₫');

            tr.find('.image').html('<img src="' + ui.item.url_image + '" width="150" height="100">')

            updateTotalPrice();
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.name + "<br>" + item.category.name + "</div>")
            .appendTo(ul);
    };
}

function updateTotalPrice() {
    var total = 0;
    $('tr.product').each(function (index, value) {
        let price = parseInt($(value).find('input.price').val());
        let quantity = parseInt($(value).find('td.quantity input').val());
        let totalPrice = 0;
        totalPrice = totalPrice + (price * quantity);
        if (isNaN(totalPrice)) {
            totalPrice = 0;
        }
        total += totalPrice;
    });
    if (isNaN(total)) {
        total = 0;
    }
    $('#totalPrice').text(total.format() + '₫');
}
