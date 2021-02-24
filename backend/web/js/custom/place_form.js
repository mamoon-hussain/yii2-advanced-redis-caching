$(document).on('click', '.add-new-content', function (e) {

    e.preventDefault();

    var number=0;
    var lastContentId=$('.one-content').last().data('id');

    // alert(lastContentId);
    if(lastContentId === undefined || lastContentId === null){
        number=0;
    } else{
        number=parseInt(lastContentId)+1;

    }
    var value = $(this).val();
    // alert(value);
    // $.get(window.url + '/'+window.lang+'/product/add-new-image')
    $.get(value,{id:number})
        .done(function (data) {
            $('#more-contents').append(data);
        });
});

$(document).on('click', '.delete-con', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $('#contentContainer'+id).remove();
    }
);


$(document).on('click', '.add-new-image', function (e) {

    e.preventDefault();
    var number=0;
    var lastPreviewImageId=$('.one-preview-image').last().data('id');
    //alert(lastPreviewImageId);
    if(lastPreviewImageId === undefined || lastPreviewImageId === null){
        number=0;
    } else{
        number=parseInt(lastPreviewImageId)+1;
    }
    var value = $(this).val();
    // $.get(window.url + '/'+window.lang+'/product/add-new-image')
    $.get(value,{id:number})
        .done(function (data) {
            $('#preview-images').append(data);
        });
});

$(document).on('click', '.delete-preview', function (e) {

        e.preventDefault();
        var id=$(this).data('id');
        $('#previewImageContainer'+id).remove();
    }
);

$(document).on('change', 'input[name ="Product[has_offer]"]', function (e) {
    e.preventDefault();
    if ($(this).is(":checked")) {
        if($('.has_offer_div').hasClass('hidden')){
            $('.has_offer_div').removeClass('hidden');
        }
    } else {
        if(!$('.has_offer_div').hasClass('hidden')){
            $('.has_offer_div').addClass('hidden');
        }
    }
});