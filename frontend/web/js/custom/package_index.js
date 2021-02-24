$(function () {
    $(document).ready(function () {
        // var imageList = Array();
        // var public_url = window.url.replace('/en', '').replace('/ar', '') + '/public/place_images';
        //
        // for (var i = 1; i <= 12; i++) {
        //     imageList[i] = new Image(70, 70);
        //     imageList[i].src =  public_url + "/tables_" + i + ".png";
        // }


        $(document).on('change', '.select_class', function (e) {
            var value = $(this).val();
            $.get(window.url  + '/site/get-place-image', {id: value}, function(data){
                var data = $.parseJSON(data);
                $("img[name='myImage']").attr('src', data.url);
            });
            calculatePrice();
        });

        $(document).on('change', '#request-start_date', function (e) {
            calculatePrice();
        });

        function calculatePrice() {
            var table = $('.select_class').val();
            var start_date = $('#request-start_date').val();
            $("#summery").html('');
            if(table && start_date){
                $.get(window.url  + '/site/get-place-price', {t: table, d: start_date}, function(data){
                    var data = $.parseJSON(data);

                    $("#summery").html('<div class="alert alert-success" role="alert">\n' +
                        data.text +
                        '</div>');
                });
            }
        }
    });

})
