import {timer} from 'rxjs';

function slideUp(element, duration) {
    element.style.transitionProperty = 'height';
    element.style.transitionDuration = `${duration}ms`;
    element.style.height = `${element.offsetHeight}px`;
    element.offsetHeight;
    element.style.overflow = 'hidden';
    element.style.height = 0;

    const removeAttributes = (target) => () => {
        element.style.display = 'none';
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    };

    const source = timer(duration);
    source.subscribe(removeAttributes(element));
}

export default slideUp;
