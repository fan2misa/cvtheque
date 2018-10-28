/*
 * Gestion des modals
 */

$(function () {

    $('.modal[data-modal-ajax]').on('shown.bs.modal', function () {
        var modal = $(this);

        var template = Handlebars.compile($('#theme-template').html());

        $(this).find('.modal-body .row').empty();

        $.ajax({
            url: $(this).attr('data-modal-ajax'),
            success: function (data, textStatus, jqXHR) {
                data.themes.forEach(function (theme) {
                    var col = $('<div />', {'class': 'col-xs-12 col-sm-6 col-md-4'});
                    modal.find('.modal-body .row').append(col.append(template(theme)));
                });
            }
        })
    });

});
