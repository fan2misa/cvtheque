/*
 * Gestion des formulaires avec gestion de collection
 */

$(function () {

    $(document).on('click', '[data-prototype-container] [data-prototype-button-add]', function () {
        var container = $(this).closest('[data-prototype-container]');
        var index = container.find(container.attr('data-prototype-container')).find('[data-prototype-line]').length;
        var form = container.attr('data-prototype');

        console.log(index);

        container.find(container.attr('data-prototype-container')).append(form.replace(/__name__/g, index));
    });

    $(document).on('click', '[data-prototype-container] [data-prototype-button-remove]', function () {
        $(this).closest('[data-prototype-line]').remove();
    });

});
