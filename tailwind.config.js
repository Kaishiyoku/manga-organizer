const {colors} = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/bootstrap.js',
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
            maxHeight: {
                48: '12rem',
            },
        },
    },
    variants: {
        'shadowOutline': ['focus'],
    },
    plugins: [],
}
