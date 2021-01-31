var config = {
    'class_confirm' : 'a.option-delete-modal',
    'class_restore' : 'a.option-restore-modal',
    'class_done' : 'a.option-done-modal',
    'check_all' : '#check-all',
    'delete_all': '#deleteAll',
    'btn_update_status': '.btn_update_status',
    'btn_show_home' : '.btn_show_home',
    'rand_code_suppliers' : '.rand-code-suppliers',
    'code_suppliers' : '#code-suppliers',

};

var updateStatus = function (data, link) {
	$.ajax({
		url: link,
		type: 'post',
		async: true,
		dataType: 'json',
		data: data,
		success: function (data) {
		    console.log(data);
		    if(data.code == 1) {
                var link_onload = baseURL + window.location.pathname;
                window.location.href = link_onload;
            } else {
		        alert('errors update');
            }

		},
		error: function (xhr, ajaxOptions, thrownError) {
            console.log(ajaxOptions);
		}
	});
};
function randomString(len, charSet) {
    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz,randomPoz+1);
    }
    return randomString;
}

var init_function = {
    init: function () {
        let _this = this;
        _this.showModalConfirmDelete();
        _this.showModalConfirmRestore();
        _this.showModalConfirmDone();
        _this.checkAll();
        _this.deleteAllAjax();
        _this.updateStatusUser();
        _this.bs_input_file();
        _this.showImage();
        _this.updateShowHome();
        _this.randomCodeSuppliers();
    },
    showModalConfirmDelete: function () {
        $(config.class_confirm).confirm({
            title: 'Chú ý',
            content: "Bạn có muốn xóa dữ liệu này không?",
            icon: 'fa fa-warning',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'Đồng ý',
                    btnClass: 'btn-blue',
                    action: function () {
                        location.href = this.$target.attr('href');
                    }
                },
                cancel: {
                    text: 'Hủy bỏ',
                    btnClass: 'btn-danger',
                    action: function () {
                    }
                }
            }
        });
    },
    showModalConfirmRestore: function () {
        $(config.class_restore).confirm({
            title: 'Chú ý',
            content: "Bạn có muốn khôi phục dữ liệu này không?",
            icon: 'fa fa-warning',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'Đồng ý',
                    btnClass: 'btn-blue',
                    action: function () {
                        location.href = this.$target.attr('href');
                    }
                },
                cancel: {
                    text: 'Hủy bỏ',
                    btnClass: 'btn-danger',
                    action: function () {
                    }
                }
            }
        });
    },
    showModalConfirmDone: function () {
        $(config.class_done).confirm({
            title: 'Chú ý',
            content: "Bạn có muốn hoàn tất đơn hàng này không?",
            icon: 'fa fa-warning',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'Đồng ý',
                    btnClass: 'btn-blue',
                    action: function () {
                        location.href = this.$target.attr('href');
                    }
                },
                cancel: {
                    text: 'Hủy bỏ',
                    btnClass: 'btn-danger',
                    action: function () {
                    }
                }
            }
        });
    },
    checkAll : function () {
        $(config.check_all).click(function()
        {
            var checkedStatus = this.checked;
            $("#checkAll tbody tr td:first-child input:checkbox").each(function()
            {
                var tr = $(this).parents('tr');
                this.checked = checkedStatus;

                if (checkedStatus == this.checked)
                {
                    $(this).closest('.checker > span').removeClass('checked');
                    tr.removeClass('active')
                }
                if (this.checked)
                {
                    $(this).closest('.checker > span').addClass('checked');
                    tr.addClass('active')
                }
            });
        });
    },

    deleteAllAjax : function () {
        $(config.delete_all).click(function (e) {

            var link = $(this).attr('link');
            var _token = $('#_token').val();

            if(!window.confirm('すべてのデータを削除すると復元できなくなりますか？ そして、データに関連するすべての情報が削除されます')) {
                e.preventDefault();
                return false;
            }

            var ids = new Array();

            $('[name="id[]"]:checked').each(function()
            {
                ids.push($(this).val());
            });
            $.ajax({
                url: link,
                type: 'post',
                async: true,
                dataType: 'json',
                data: {
                    'ids': ids,
                    '_token' : _token
                },
                success: function (data) {
                    $(data.ids).each(function(id, val)
                    {
                        //xoa cac the <tr> chua danh muc tung ung
                        $('tr.row_'+val).fadeOut();
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        });
    },
    bs_input_file: function () {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    },
    showImage: function() {
        $("#input_img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_render').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    },
	updateStatusUser: function () {
        $(config.btn_update_status).click(function () {
            var status = $(this).attr('status');
			var link = $(this).attr('link');
			var _token = $(this).attr('_token');
			var id = $(this).attr('id');
			var data = {
				'status': status,
                '_token' : _token,
                'id' : id
            };
			updateStatus(data, link);
		});
	},
    updateShowHome: function () {
		$(config.btn_show_home).click(function () {
			var show_home = $(this).attr('show_home');
			var link = $(this).attr('link');
			var _token = $(this).attr('_token');
			var id = $(this).attr('id');
			var data = {
				'show_home': show_home,
				'_token' : _token,
				'id' : id
			};
			updateStatus(data, link);
		});
	},
    randomCodeSuppliers: function () {
        $(config.rand_code_suppliers).click(function () {
            $(config.code_suppliers).val(randomString(15));
        });
    },

}
$(function () {
    init_function.init();

    setTimeout(function(){
        $('.alert').slideUp(2000);
    }, 3000);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.update_status').click(function () {
        var status = $(this).attr('status');
        var link = $(this).attr('link');
        var id = $(this).attr('id');
        var data = {
            'status': status,
            'id' : id
        };
        updateStatus(data, link);
    });

    $('.update_show_sidebar').click(function () {
        var status = $(this).attr('status');
        var link = $(this).attr('link');
        var id = $(this).attr('id');
        var data = {
            'status': status,
            'id' : id
        };
        updateStatus(data, link);
    });

    $('.update_arrived_news').click(function () {
        var status = $(this).attr('status');
        var link = $(this).attr('link');
        var id = $(this).attr('id');
        var data = {
            'status': status,
            'id' : id
        };
        updateStatus(data, link);
    });
});



