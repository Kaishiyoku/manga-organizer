
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {
    $('[data-submit]').each(function () {
        const $this = $(this);

        $this.click(function (event) {
            event.preventDefault();

            $($this.attr('data-submit')).submit();
        });
    });

    $('[data-confirm]').click(function () {
        let confirmationText = $(this).attr('data-confirm');

        if (_.isEmpty(confirmationText) || confirmationText == 1) {
            confirmationText = 'Are you sure?';
        }

        if (!confirm(confirmationText)) {
            return false;
        }
    });
});