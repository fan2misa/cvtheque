/*
 * Gestion des modals
 */

$(function () {

    $('.modal[data-modal-ajax]').on('shown.bs.modal', function () {
        var modal = $(this);
        var template = Handlebars.compile($('#themes-template').html());
        var row = $('<div />', {'class': 'row'});

        $.ajax({
            url: $(this).attr('data-modal-ajax'),
            beforeSend: function() {
                modal.find('.modal-body').empty();
                modal.find('.modal-body').append($('<div />', {'class': 'loader'}).append($('<i />', {'class': 'fa fa-spinner fa-pulse fa-3x fa-fw'})));
            },
            success: function (data, textStatus, jqXHR) {
                data.themes.forEach(function (theme) {
                    modal.find('.modal-body').empty();
                    row.append($('<div />', {'class': 'col-xs-12 col-sm-6 col-md-4'}).append(template({cv: data.cv, theme: theme})));
                });

                modal.find('.modal-body').append(row);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                modal.find('.modal-body').empty();
                console.log(jqXHR, textStatus, errorThrown);
            }
        })
    });

});
