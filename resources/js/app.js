
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {
    $('[data-click]').each(function () {
        const $this = $(this);

        $this.click((event) => {
            event.preventDefault();

            $($this.attr('data-click')).submit();
        });
    });

    $('[data-confirm]').click(function () {
        const confirmationText = $(this).attr('data-confirm') || 'Are you sure?';

        if (!confirm(confirmationText)) {
            return false;
        }
    });

    $('[data-toggle="dropdown"]').click(function (event) {
        event.stopPropagation();

        const $this = $(this);
        const $dropdown = $($this.data('target'));

        $dropdown.toggleClass('hidden');
    });

    $(window).click((event) => {
        $('[data-toggle="dropdown"]').each(function () {
            const $this = $(this);

            $($this.data('target')).addClass('hidden');
        });
    });

    $('[data-toggle="expand"]').click(function () {
        const $this = $(this);

        const $container = $($this.data('target'));

        if ($container.hasClass('opacity-0')) {
            $container.removeClass('hidden');

            setTimeout(() => $container.removeClass('opacity-0'), 200);
        } else {
            $container.addClass('opacity-0');

            setTimeout(() => $container.addClass('hidden'), 150);
        }
    });
});
