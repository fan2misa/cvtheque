/*
 * Gestion des checkbox avec appel ajax
 */

$(function () {

    $('[data-on-click]').each(function () {
        $(this).is(':checked')
            ? $($(this).attr('data-on-click-container')).show()
            : $($(this).attr('data-on-click-container')).hide();
    });

    $(document).on('change', '[data-on-click]', function () {

        var $checkbox = $(this);

        if ($checkbox.is('[data-on-click-ajax]')) {

            var html = $($checkbox.attr('data-on-click-container')).html();

            $.ajax({
                url: $checkbox.attr('data-on-click-ajax'),
                data: {
                    checked: $checkbox.is(':checked') ? 1 : 0
                },
                beforeSend: function() {
                    if ($checkbox.is(':checked')) {
                        $($checkbox.attr('data-on-click-container'))
                            .show()
                            .empty()
                            .append($('<div />', {'class': 'loader'}).append($('<i />', {'class': 'fa fa-spinner fa-pulse fa-3x fa-fw'})));
                    } else {
                        $($checkbox.attr('data-on-click-container')).hide();
                    }
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.checked) {
                        $($checkbox.attr('data-on-click-container'))
                            .show()
                            .html(html);
                    } else {
                        $($checkbox.attr('data-on-click-container')).hide();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            })

        } else {
            $checkbox.is(':checked')
                ? $($checkbox.attr('data-on-click-container')).show()
                : $($checkbox.attr('data-on-click-container')).hide();
        }
    });

});

