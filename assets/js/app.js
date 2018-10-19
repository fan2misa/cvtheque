/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    $('.modal').on('shown.bs.modal', function () {
        if (typeof $(this).attr('data-prototype') !== "undefined") {
            var index = $('[data-container=' + $(this).attr('data-type-container') + '] .modal').length;
            var form = $(this).attr('data-prototype');
            $(this).find('.modal-body').html(form.replace(/__name__/g, index));
        } else {
            $(this).attr('data-form', $(this).find('.modal-body').html());
        }
    });

    $('.modal').on('hide.bs.modal', function () {
        if (typeof $(this).attr('data-prototype') !== "undefined") {
            $(this).find('.modal-body').empty();
        } else {
            $(this).find('.modal-body').html($(this).attr('data-form'));
        }
    });
});

    