import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
],



    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens:{
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                 'xl': '1440px',   // increased from 1280px
                '2xl': '2400px',

            },
        },
    },

    plugins: [forms],
};
