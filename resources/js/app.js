/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import onDomReady from './onDomReady';
import tippy from 'tippy.js';
import bonanza from 'bonanza';

require('./bootstrap');

onDomReady(() => {
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

    document.querySelectorAll('[data-provide-typeahead]').forEach((element) => {
        const targetElement = document.querySelector(element.getAttribute('data-target'));
        const targetProperty = element.getAttribute('data-target-property');
        const url = element.getAttribute('data-url');
        const minLength = parseInt(element.getAttribute('data-min-length'), 10) || 0
        const loadingIndicatorElement = document.querySelector(element.getAttribute('data-loading-indicator'));

        const {load_more, loading} = window.config.typeahead;

        bonanza(element, {
            templates: {
                itemLabel: (obj) => obj.title,
                // item: '',
                label: (obj) => obj.title,
                isDisabled: (obj) => false,
                noResults: (search) => `No results for ${search}`,
                loadMore: load_more,
                loading: loading,
            },
            css: {
                container: 'dropdown absolute overflow-y-auto max-h-48', // div
                hide: 'hidden',
                list: '', // ul
                item: 'dropdown-item', // li
                disabled: '',
                selected: 'dropdown-item-active',
                // loading: '', // li
                // loadMore: '', // li
                // noResults: '', // li
                // inputLoading: '', // input
                match: '',
            },
            openOnFocus: true,
            showLoading: true,
            showLoadMore: true,
            limit: 10,
            scrollDistance: 0,
            getItems: (result) => result,
        }, (query, callback) => {
            if (query.search.length >= minLength) {
                axios.post(url, {query: query.search})
                    .then(({data}) => {
                        callback(null, data);
                    })
                    .catch(() => {
                        element.classList.remove('input-typeahead');
                        element.classList.add('input-default');
                        loadingIndicatorElement.classList.add('hidden');
                    });
            }
        })
            .on('change', (item) => {
                targetElement.value = item[targetProperty];
            })
            .on('search', (query) => {
                element.classList.remove('input-default');
                element.classList.add('input-typeahead');
                loadingIndicatorElement.classList.remove('hidden');
            })
            .on('success', (result, query) => {
                element.classList.remove('input-typeahead');
                element.classList.add('input-default');
                loadingIndicatorElement.classList.add('hidden');
            });
    });
});
