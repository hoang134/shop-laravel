$(function () {
    $("#thumb").sortable({
        cursor: 'move',
        opacity: 0.7,
        placeholder: 'ui-state-highlight',
        update: function(event, ui) {
            updateSortNo();
        }
    });

    var proto_img = '<div class="c-form__fileUploadThumbnail" style="background-image:url(\'__path__\');">' +
        '<a class="delete-image"><i class="fa fa-fw fa-close"></i></a>' +
        '</div>';
    var proto_add = '<input type="hidden" id="product_add_images___name__" name="product_add_images[]" required="required" />';
    var proto_del = '<input type="hidden" id="product_delete_images___name__" name="product_delete_images[]" required="required" />';

    var count_add = $('input[name*="product_add_images"]').length
    $('#productImages').fileupload({
        url: urlAddImage,
        type: "post",
        sequentialUploads: true,
        singleFileUploads: false,
        dataType: 'json',
        dropZone: $('#upload-zone'),
        done: function(e, data) {
            $('.progress').hide();
            var paths = data.result.paths;
            $.each(data.result.files, function(index, file) {
                var path = paths[index];
                var $img = $(proto_img.replace(/__path__/g, path));
                var $new_img = $(proto_add.replace(/__name__/g, count_add));
                $new_img.val(paths[index]);
                $child = $img.append($new_img);
                $('#thumb').append($child);
                count_add++;
            });
            updateSortNo();
        },
        fail: function(e, data) {
            notification('danger', 'Tải lên thất bại');
        },
        always: function(e, data) {
            $('.progress').hide();
            $('.progress .progress-bar').width('0%');
        },
        start: function(e, data) {
            $('.progress').show();
        },
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 2048 * 2048,
        progressall: function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        processalways: function(e, data) {
            if (data.error) {
                notification('danger', data.message);
            }
        }
    });

    var count_del = 0;
    $("#thumb").on("click", '.delete-image', function() {
        var $new_delete_image = $(proto_del.replace(/__name__/g, count_del));
        var thumbnail = $(this).parents('div.c-form__fileUploadThumbnail');
        var src = $(thumbnail).find('input').val();
        $new_delete_image.val(src);
        $("#thumb").append($new_delete_image);
        $(thumbnail).remove();
        updateSortNo();
        count_del++;
    });

    function updateSortNo() {
        $("#thumb div").each(function(index) {
            $(this).find(".sort_no_images").remove();
            filename = $(this).find("input[type='hidden']").val();
            $sortNo = $('<input type="hidden" class="sort_no_images" name="sort_no_images[]" />');
            $sortNo.val(filename + '//' + parseInt(index + 1));
            $(this).append($sortNo);
        });
    }
    updateSortNo();

    $('#btn-preview').on('click', function() {
        var dynamicEl = [];
        $("#thumb div").each(function(index) {
            var bg = $(this).css('background-image');
            bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
            dynamicEl.push({
                "src": bg
            })
        });

        if (dynamicEl.length > 0) {
            $(this).lightGallery({
                dynamic: true,
                dynamicEl: dynamicEl
            });
        }
    });
});
