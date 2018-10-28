/*
 * Gestion des modals
 */

$(function () {

    $('.modal[data-modal-ajax]').on('shown.bs.modal', function () {
        $.ajax({
            url: $(this).attr('data-modal-ajax'),
            success: function (data, textStatus, jqXHR) {
                console.log(data, textStatus, jqXHR);
            }
        })
    });

});
