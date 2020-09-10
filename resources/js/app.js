/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import tippy  from 'tippy.js';
import onDomReady from './onDomReady';

require('./bootstrap');

onDomReady(() =>  {
    document.querySelectorAll('[data-click]').forEach((element) => {
        element.addEventListener('click', (event) => {
            event.preventDefault();

            document.querySelector(element.getAttribute('data-click')).submit();
        });
    });

    document.querySelectorAll('[data-confirm]').forEach((element) => {
        element.addEventListener('click', (event) => {
            const confirmationText = element.getAttribute('data-confirm') || 'Are you sure?';

            if (!confirm(confirmationText)) {
                return false;
            }
        });
    });

    document.querySelectorAll('[id^=lang-link-]').forEach((element) => {
        element.addEventListener('click', (event) => {
            event.preventDefault();

            document.getElementById(element.getAttribute('id').replace('link', 'form')).submit();
        });
    });

    tippy('[data-tooltip-content]', {
        theme: 'light-border',
        content: (reference) => reference.getAttribute('data-tooltip-content'),
    });

    tippy('[data-provide-dropdown]', {
        theme: 'dropdown',
        allowHTML: true,
        interactive: true,
        arrow: 'false',
        trigger: 'click',
        placement: 'bottom-start',
        offset: [0, -5],
        animation: 'shift-away-subtle',
        content(reference) {
            let dropdown = document.querySelector(reference.getAttribute('data-dropdown-target'));
            dropdown.classList.remove('hidden');

            return dropdown;
        },
    });
});
