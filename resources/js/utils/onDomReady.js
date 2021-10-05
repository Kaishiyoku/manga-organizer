const onDomReady = (callback) => {
    const readyState = document.readyState;

    if (readyState === 'complete' || (readyState !== 'loading' && !document.documentElement.doScroll)) {
        callback();

        return;
    }

    document.addEventListener('DOMContentLoaded', callback);
};

export default onDomReady;
