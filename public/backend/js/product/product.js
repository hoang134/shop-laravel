$(function () {
    const listProducts = $('#listProducts').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.get_data_product,
            type: 'POST',
            data: function(d){
                d.name = $('#product_name').val();
            },
        },
        order: [],
        columnDefs: [{orderable: false, targets: 'nosort',}],
        columns: [
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'url_product', name: 'url_product', class: 'text-left'},
            {data: 'url_image', name: 'url_image', class: 'text-left'},
            {data: 'quantity', name: 'quantity', class: 'text-left'},
            {data: 'status', name: 'status', class: 'text-left'},
            {data: 'action', name: 'action', class: 'text-left'},
        ]
    });

    let btn_search_product = $('.btn-search-product');
    btn_search_product.click(function () {
        listProducts.ajax.reload();
    });
    btn_search_product.trigger('click');
});
