$(function () {
    const listOrders = $('#listOrders').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.get_data_order,
            type: 'POST',
            data: function(d){
                d.code = $('#order_name').val();
                d.name_customer = $('#order_customer').val();
                d.phone = $('#order_phone').val();
            },
        },
        order: [],
        columnDefs: [{orderable: false, targets: 'nosort',}],
        columns: [
            {data: 'code', name: 'code', class: 'text-left'},
            {data: 'name_customer', name: 'name_customer', class: 'text-left'},
            {data: 'phone', name: 'phone', class: 'text-left'},
            {data: 'create', name: 'create', class: 'text-left'},
            {data: 'status', name: 'status', class: 'text-left'},
            {data: 'action', name: 'action', class: 'text-left'},
        ]
    });

    let btn_search_product = $('.btn-search-product');
    btn_search_product.click(function () {
        listOrders.ajax.reload();
    });
    btn_search_product.trigger('click');
});
