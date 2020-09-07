import {timer} from 'rxjs';

function slideDown(element, duration) {
    element.style.removeProperty('display');

    const display = window.getComputedStyle(element).display;

    element.style.display = display === 'none' ? 'block' : display;

    const height = element.offsetHeight;

    element.style.overflow = 'hidden';
    element.style.height = 0;
    element.offsetHeight;
    element.style.boxSizing = 'border-box';
    element.style.transitionProperty = "height";
    element.style.transitionDuration = `#{duration}ms`;
    element.style.height = `${height}px`;

    const removeAttributes = (target) => () => {
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    };

    const source = timer(duration);
    source.subscribe(removeAttributes);
}

export default slideDown;
