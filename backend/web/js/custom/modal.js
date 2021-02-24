$(function () {

    //get the click of the button
    $(document).on('click', '.activity-view-link', function (e) {
        e.preventDefault();

        var viewModal = $('#myModal').modal('show');
        var viewModal = $('#myModal').find('.modal-content');
        viewModal.empty();
        viewModal.show();
        var loading_text = $('#myModal').data('loading');
        var close_text = $('#myModal').data('close');
        viewModal.html('<div class="modal-header">\
                <h5 class="modal-title"></h5>\
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                    <span aria-hidden="true">×</span>\
                </button>\
            </div>\
            <div class="modal-body">'+loading_text+'</div>\
            <div class="modal-footer">\
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="">'+close_text+'</button>\
            </div>');
        viewModal.load($(this).attr('value'));
    });

    $(document).on('submit', 'form', function (e) {
        $(this).find(':input[type=submit]').prop('disabled', true);
        $(this).find('.btn-primary').prop('disabled', true);
    });
});

$(document).ready(function () {
    $('#select_all').on('click', function () {
        if (this.checked) {
            $('.checkbox_c').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkbox_c').each(function () {
                this.checked = false;
            });
        }
    });

    $('.checkbox_c').on('click', function () {
        if ($('.checkbox_c:checked').length == $('.checkbox_c').length) {
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
    });

    $(document).on('click', '.activity-view-link-form-check', function (e) {
        e.preventDefault();
        $('#myModal').find('#modalContent').empty();
        var viewModal = $('#myModal').modal('show')
            .find('#modalContent');
        viewModal.html('<div class="modal-content">\n\
<div class="modal-header">\n\
<button type="button" class="close" data-dismiss="modal">&times;</button>\n\
<h4 class="modal-title">\n\
</h4></div>\n\
<div class="modal-body">\n\
<p>Loading...</p>\n\
</div>\n\
</div>');

        var form = $('.form_unprinted_checks');
        var action = $(this).attr('value');
        $.post(action, form.serialize())
            .done(function (res) {
                viewModal.html(res);
            });
    });

    $(document).on('click', '.activity-view-link-get', function (e) {
        e.preventDefault();
        $('#myModal').find('#modalContent').empty();
        var viewModal = $('#myModal').modal('show')
            .find('#modalContent');
        viewModal.html('<div class="modal-content">\n\
<div class="modal-header">\n\
<button type="button" class="close" data-dismiss="modal">&times;</button>\n\
<h4 class="modal-title">\n\
</h4></div>\n\
<div class="modal-body">\n\
<p>Loading...</p>\n\
</div>\n\
</div>');

        var current_url = window.location.href;
        var get_values = current_url.split('?');
        var a_href = $(this).attr("value");
        $(this).attr("value", a_href + '?' + get_values[1]);
        viewModal.load($(this).attr('value'));
    });

    $(document).on('click', '.ajax_save_reset_select2', function (e) {
        e.preventDefault();
        var select_reset_url = $(this).attr('data-select_reset_url');
        var select_reset_field_class = $(this).attr('data-select_reset_field_class');
        $.ajax({
            type: "POST",
            url: $(this).closest('form').attr('action'),
            data: $(this).closest('form').serialize(),
            dataType: "json",
            success: function(data) {
                notif({
                    msg: data.msg,
                    type: data.type
                });
                resetSelect(select_reset_url, select_reset_field_class);
            },
            error: function(e) {
                // debugger
            }
        });
    });

    $(document).on('submit', 'form', function (e) {
        $(this).find(':input[type=submit]').prop('disabled', true);
        $(this).find('.btn-primary').prop('disabled', true);
    });

    $(document).on('click', '.modal-form_change_by_btn_value', function (e) {
        e.preventDefault();
        $('#myModal').find('#modalContent').empty();
        var viewModal = $('#myModal').modal('show')
            .find('#modalContent');
        viewModal.html('<div class="modal-content">\n\
                            <div class="modal-header">\n\
                                <button type="button" class="close" data-dismiss="modal">&times;</button>\n\
                                <h4 class="modal-title">\n\
                                </h4></div>\n\
                                <div class="modal-body">\n\
                                <p>Loading...</p>\n\
                            </div>\n\
                        </div>');
        var action = $(this).attr('value');
        var form = $('.form_loading_plan');
        $.post(action, form.serialize())
            .done(function (res) {
                viewModal.html(res);
            });
    });
});

function resetSelect(reset_url, field_class){
    $('.'+field_class).val(null).trigger('change');
    $('.'+field_class).empty().trigger("change");
    $.get(reset_url)
        .done(function (data) {
            var data = $.parseJSON(data);
            var lastItem = 1;
            data.forEach(function (item) {
                lastItem = item.id;
                var newOption = new Option(item.text, item.id, false, false);
                $('.'+field_class).append(newOption);
            });
            $('.'+field_class).val(lastItem).trigger('change');
            $('.'+field_class).trigger('change');
        });

}













