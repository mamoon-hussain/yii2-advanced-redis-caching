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
            calculatePrice();
        });

        $(document).on('change', '#request-class_period', function (e) {
            calculatePrice();
        });

        $(document).on('change', '#request-date_range', function (e) {
            calculatePrice();
        });

        function calculatePrice() {
            var hall = $('.select_class').val();
            var period = $('#request-class_period').val();
            var date_range = $('#request-date_range').val();
            $("#summery").html('');
            if(hall && period && date_range){
                $.get(window.url  + '/site/get-hall-price', {h: hall, p:period, d: date_range}, function(data){
                    var data = $.parseJSON(data);
                    $("#summery").html('<div class="alert alert-success" role="alert">\n' +
                        data.text +
                        '</div>');
                });
            }
        }
    });

})
