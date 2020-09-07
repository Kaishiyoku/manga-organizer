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
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui'),
        require('tailwindcss-shadow-outline-colors')(),
    ],
}
