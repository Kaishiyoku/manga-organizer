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

    document.querySelectorAll('[data-provide-manga-search]').forEach((element) => {
        const url = element.getAttribute('data-url');
        const searchInputElement = document.querySelector(element.getAttribute('data-manga-search-input'));
        const targetInputElement = document.querySelector(element.getAttribute('data-target-input'));
        const searchResultContainer = document.querySelector(element.getAttribute('data-manga-search-results-container'));
        const buttonText = element.textContent;

        searchInputElement.addEventListener('keyup', (event) => {
            element.disabled = searchInputElement.value.length < 3;
        });

        element.addEventListener('click', (event) => {
            searchInputElement.classList.remove('has-error-alternative');
            searchResultContainer.innerHTML = '';

            let loadingSpinnerElement = document.createElement('i');
            loadingSpinnerElement.classList.add('fas', 'fa-spinner', 'fa-spin');

            element.textContent = '';
            element.appendChild(loadingSpinnerElement);
            element.disabled = true;

            axios.post(url, {query: searchInputElement.value})
                .then(({data}) => {
                    data.forEach((item) => {
                        let resultElement = document.createElement('div');
                        resultElement.setAttribute('data-manga-search-result-id', item.malId);
                        resultElement.classList.add('dropdown-item', 'flex', 'items-start');

                        let imageElement = document.createElement('img');
                        imageElement.setAttribute('src', item.imageUrl);
                        imageElement.setAttribute('alt', item.title);
                        imageElement.classList.add('w-8', 'mr-2');

                        let headlineContainerElement = document.createElement('div');

                        let headlineElement = document.createElement('div');
                        headlineElement.textContent = item.title;

                        let subHeadlineElement = document.createElement('div');
                        subHeadlineElement.classList.add('text-xs', 'text-gray-400');
                        subHeadlineElement.textContent = item.synopsis;

                        headlineContainerElement.appendChild(headlineElement);
                        headlineContainerElement.appendChild(subHeadlineElement);

                        resultElement.appendChild(imageElement);
                        resultElement.appendChild(headlineContainerElement);

                        searchResultContainer.appendChild(resultElement);

                        searchResultContainer.querySelectorAll('[data-manga-search-result-id]').forEach((el) => {
                            el.addEventListener('click', () => {
                                targetInputElement.value = el.getAttribute('data-manga-search-result-id');
                                searchInputElement.value = '';
                                searchResultContainer.innerHTML = '';
                                element.disabled = true;
                            });
                        });

                        element.innerHTML = buttonText;
                        element.disabled = false;
                    });
                })
                .catch(() => {
                    searchInputElement.classList.add('has-error-alternative');
                    element.innerHTML = buttonText;
                    element.disabled = false;
                });
        });
    });

    tippy('[data-tooltip-content]', {
        theme: 'light-border',
        content: (reference) => reference.getAttribute('data-tooltip-content'),
    });

    tippy('[data-tooltip-query-selector]', {
        theme: 'light-border',
        content: (reference) => document.querySelector(reference.getAttribute('data-tooltip-query-selector')),
        placement: 'top-start',
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
