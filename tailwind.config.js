import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
                cursive: ['Great Vibes', 'cursive'],
            },
            safelist: [
                {
                    pattern: /bg-(red|green|blue|indigo|emerald|teal|yellow|gray)-(100|200|300|400|500|600|700|800|900)/,
                },
                {
                    pattern: /hover:bg-(red|green|blue|indigo|emerald|teal|yellow|gray)-(100|200|300|400|500|600|700|800|900)/,
                },
                {
                    pattern: /text-(red|green|blue|indigo|emerald|teal|yellow|gray)-(100|200|300|400|500|600|700|800|900)/,
                },
            ],
            colors: {
                brand: {
                    gold: {
                        50: '#fbf9f2',
                        100: '#f5f0db',
                        200: '#ece1b7',
                        300: '#e0cc89',
                        400: '#d4af37', // Primary Gold
                        500: '#b8860b', // Dark Gold
                        600: '#996515',
                        700: '#7a4d14',
                        800: '#633d15',
                        900: '#533416',
                    },
                    cream: {
                        50: '#fffdf5',
                        100: '#fffdd0', // Ivory/Cream
                        200: '#fef9a3',
                        300: '#fdf16d',
                        400: '#fce63b',
                        500: '#fbd410',
                    },
                    sage: {
                        50: '#f6f7f2',
                        100: '#ebede1',
                        200: '#d3d8c1',
                        300: '#abb596',
                        400: '#8a9a5b', // Sage Green
                        500: '#6e7d48',
                    }
                }
            },
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
    ],
};
