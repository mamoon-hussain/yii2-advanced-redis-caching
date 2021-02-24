$(document).on("click",".select_all",function(){
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

$(document).on("click",".checkbox_c",function(){
    if ($('.checkbox_c:checked').length == $('.checkbox_c').length) {
        $('.select_all').prop('checked', true);
    } else {
        $('.select_all').prop('checked', false);
    }
});

//
$(document).on("click",".select_all_table",function(){
    var id = $(this).data('id');
    if (this.checked) {
        $('.select_'+id).each(function () {
            this.checked = true;
        });
    } else {
        $('.select_'+id).each(function () {
            this.checked = false;
        });
    }
});

$(document).on("click",".select_one",function(){
    var id = $(this).data('id');
    if ($('.select_'+id+':checked').length == $('.select_'+id).length) {
        $('.select_all_table_'+id).prop('checked', true);
    } else {
        $('.select_all_table_'+id).prop('checked', false);
    }
});
























