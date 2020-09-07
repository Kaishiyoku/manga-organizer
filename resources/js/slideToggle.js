import slideDown from './slideDown';
import slideUp from './slideUp';

function slideToggle(element, duration) {
    const styleDisplay = window.getComputedStyle(element).display;

    const fn = styleDisplay === 'none' ? slideDown : slideUp;

    fn(element, duration);
}

export default slideToggle;
