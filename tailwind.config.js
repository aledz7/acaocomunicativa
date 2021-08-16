const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins','Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
              actionblue: '#224d7a',
              textcolor: '#344055',
              footerbg: '#202c39',
              textblack: '#232323',
            },
           fill: ['hover', 'focus'],

        },
        screens: {
            'xs': '475px',
            'ks': '1000px',
            ...defaultTheme.screens,
          },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
    ],
};
