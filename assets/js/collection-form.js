/*
 * Gestion des formulaires avec gestion de collection
 */

$(function () {

    $(document).on('click', '[data-prototype-container] [data-prototype-button-add]', function () {
        var container = $(this).closest('[data-prototype-container]');
        var index = container.find(container.attr('data-prototype-container')).find('[data-prototype-line]').length;
        var form = container.attr('data-prototype');

        container.find(container.attr('data-prototype-container')).append(form.replace(/__name__/g, index));
    });

    $(document).on('click', '[data-prototype-container] [data-prototype-button-remove]', function () {
        $(this).closest('[data-prototype-line]').remove();
    });

    $(document).on('click', '[data-remove]', function () {
        $(this).closest('form').find('.modal-remove').attr('data-remove-component', $(this).attr('data-remove'));
        $(this).closest('form').find('.modal-remove').find('.modal-title').text($(this).attr('data-remove-title'));
        $(this).closest('form').find('.modal-remove').find('.modal-body').text($(this).attr('data-remove-body'));
        $(this).closest('form').find('.modal-remove').modal('show');
    });

    $(document).on('click', '[data-remove-confirmed]', function () {
        $($(this).closest('.modal-remove').attr('data-remove-component')).remove();
        $(this).closest('form').submit();
    });
});
