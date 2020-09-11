const {colors} = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', 'sans-serif'],
            },
            colors: {
                purple: {
                    ...colors.purple,
                    50: '#f9f7fa',
                },
            },
            shadowOutline: {
                'shadow': '0 0 0 .2rem',
                'alpha': '.4',
            },
        },
    },
    variants: {
        'shadowOutline': ['focus'],
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('tailwindcss-shadow-outline-colors')(),
    ],
}
