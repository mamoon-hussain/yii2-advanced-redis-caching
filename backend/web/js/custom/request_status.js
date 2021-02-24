$(function () {

    //get the click of the button
    $(document).on('click', '.request-status', function (e) {
        e.preventDefault();

        var viewModal = $('#myModal').find('.modal-content');

        viewModal.empty();
        viewModal.html('<div class="modal-header">\
                <h5 class="modal-title"></h5>\
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                    <span aria-hidden="true">×</span>\
                </button>\
            </div>\
            <div class="modal-body">\
                Loading...\
            </div>\
            <div class="modal-footer">\
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
            </div>');
        viewModal.load($(this).attr('value'));
    });

});