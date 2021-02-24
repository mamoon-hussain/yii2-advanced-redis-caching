$(document).on('change', '.category_level1_select', function (e) {

    e.preventDefault();
    $('.category_level0_select').val(null).trigger('select2:change');
    var value = $(this).val();

    $.get(window.url  + '/' + window.lang + '/site/get-main-categories', {id: value}, function(data){

        var data = $.parseJSON(data);

        $('.category_level0_select').val(data.id).trigger('change.select2');
        // $('.state_select').select2('data', data.id, false);
    });
});



$(document).on('change', '.category_level0_select', function (e)
{
    e.preventDefault();
    var value = $(this).val();

    $('.category_level1_select').val(null).trigger('select2:change');
    $('.category_level1_select').empty().trigger('select2:change');

    $.get(window.url  + '/' + window.lang + '/site/get-sub-categories', {id: value}, function(data){

        var data = $.parseJSON(data);
        var value = '';
// alert(data)
        data.forEach(function (item) {
            if(!value) {
                value = item.id;
            }
            var newOption = new Option(item.text, item.id, false, false);
            $('.category_level1_select').append(newOption);
        });
// alert
        $('.category_level1_select').val(value).trigger('select2:change');
    });
});











