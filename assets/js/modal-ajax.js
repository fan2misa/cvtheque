/*
 * Gestion des modals
 */

$(function () {

    $('.modal[data-modal-ajax]').on('shown.bs.modal', function () {
        console.log($(this).attr('data-modal-ajax'));
    });

});
