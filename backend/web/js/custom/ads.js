$(document).on("change", "input[name=\"Ads[type]\"]", function (e) {
    var value = $('input[name=\"Ads[type]\"]:checked').val();
    var ad_url = $('#ad_url');
    var ad_place = $('#ad_place');

    switch (value) {
        case '1':
            removeHidden(ad_url);
            addHidden(ad_place);
            break;
        case '2':
            addHidden(ad_url);
            removeHidden(ad_place);
            break;
    }
});

function addHidden(item) {
    if(!item.hasClass('hidden')){
        item.addClass('hidden');
    }
}

function removeHidden(item) {
    if(item.hasClass('hidden')){
        item.removeClass('hidden');
    }
}