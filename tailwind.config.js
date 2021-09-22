const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    // purge: [
    //     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //     './storage/framework/views/*.php',
    //     './resources/views/**/*.blade.php',
    //     './resources/views/**/**/*.blade.php',
    //     './resources/views/**/**/**/*.blade.php',
    //     './**/*.blade.php'
    // ],
    purge: {
        layers: ['components', 'utilities'],
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './resources/views/**/**/*.blade.php',
            './resources/views/**/**/**/*.blade.php',
            './**/*.blade.php'
        ],
        options: {
            safelist: [/^bg-/, /^w-/, /^max-w-/, /^p*-/, /^m*-/]
        },

    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'wide': ['Monoton',]
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
