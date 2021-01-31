$(function () {
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: true,
        language: {
            "sEmptyTable": "Không có dữ liệu",
            "sInfo": "Hiển thị Tổng _TOTAL_ Tổng _START_ đến _END_",
            "sInfoEmpty": " Hiển thị 0 Từ 0 đến 0",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "_MENU_ Hiển thị",
            "sLoadingRecords": "Đang tải...",
            "sProcessing": "Đang tải...",
            "sSearch": "Tìm kiếm:",
            "sZeroRecords": "Không có dữ liệu",
            "oPaginate": {
                "sFirst": "Đầu tiên",
                "sLast": "Cuối cùng",
                "sNext": '<svg height="12" viewBox="0 0 12 12" width="12" xmlns="http://www.w3.org/2000/svg"><path d="m9 4.83333333c0-.17708333-.07291667-.34375-.19791667-.46875l-4.66666666-4.66666666c-.125-.125-.29166667-.19791667-.46875-.19791667-.36458334 0-.66666667.30208333-.66666667.66666667v9.33333333c0 .36458333.30208333.6666667.66666667.6666667.17708333 0 .34375-.0729167.46875-.1979167l4.66666666-4.66666667c.125-.125.19791667-.29166666.19791667-.46875z" fill="#36b3d0" fill-rule="evenodd" transform="matrix(1 0 0 -1 0 11)"/></svg>',
                "sPrevious": '<svg height="12" viewBox="0 0 12 12" width="12" xmlns="http://www.w3.org/2000/svg"><path d="m8 4.83333333c0-.17708333-.07291667-.34375-.19791667-.46875l-4.66666666-4.66666666c-.125-.125-.29166667-.19791667-.46875-.19791667-.36458334 0-.66666667.30208333-.66666667.66666667v9.33333333c0 .36458333.30208333.6666667.66666667.6666667.17708333 0 .34375-.0729167.46875-.1979167l4.66666666-4.66666667c.125-.125.19791667-.29166666.19791667-.46875z" fill="#36b3d0" fill-rule="evenodd" transform="matrix(-1 0 0 -1 10.666658 11)"/></svg>',
            },
            "oAria": {
                "sSortAscending": ": Sắp xếp theo thứ tự tăng dần",
                "sSortDescending": ": Sắp xếp theo thứ tự giảm dần"
            }
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
            "<'row'<'col-sm-12'tr>>",
        // lengthMenu: [[100, 150, 300, 500, -1], [100, 150, 300, 500, "万事"]],
        pageLength: 20,
        lengthChange: false,
    });

    $.fn.dataTable.ext.order.intl = function (locales, options) {
        if (window.Intl) {
            var collator = new window.Intl.Collator(locales, options);
            var types = $.fn.dataTable.ext.type;

            delete types.order['string-pre'];
            types.order['string-asc'] = collator.compare;
            types.order['string-desc'] = function (a, b) {
                return collator.compare(a, b) * -1;
            };
        }
    };

    $.fn.dataTable.ext.order['just-num'] = function (settings, col) {
        return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
            return td.innerHTML.replace(/[^\d]/g, "");
        });
    };

    $.fn.dataTable.ext.order.intl('ja');
});
