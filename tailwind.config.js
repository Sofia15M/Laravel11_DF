import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat Alternates', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                Azul3: '#297EA3',
                Negro: '#252525',
                negro1: '#2f2e41',
                gris: '#D7D5D3',
                Azul1: '#00112D',
                Azul2: '#011640',
                Azul3: '#297EA3',
                Azul03: '297ea34',
                Azul4: '#79DCF2',
                Azul5: '#BFF9FF',
                azul: '#007bff',
                azul1: '#0056b3',
                rojo: '#AE2012',
                rojo1: '#9B2226',
                verde: '#558B2F',
                verde1: '#33691E',
                naranja: '#CA6702',
                naranja1: '#BB3E03',
                Otro: '#c2dffe',
            },
        },
    },

    variants: {
        extend: {
            ringColor: ['focus'],
            borderColor: ['focus'],
            backgroundColor: ['bg'],
        },
    },

    plugins: [forms, typography],
};
