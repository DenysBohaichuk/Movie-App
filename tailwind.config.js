import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'flash-alert', 'border-l-4', 'rounded-md', 'p-4', 'mb-2',
        'flex', 'flex-shrink-0', 'ml-3', 'text-sm', 'font-medium',
        'ml-auto', 'pl-3', '-mx-1.5', '-my-1.5', 'inline-flex',
        'rounded-md', 'p-1.5', 'h-5', 'w-5',
        'border-green-400', 'bg-green-50', 'text-green-500', 'hover:bg-green-100', 'text-green-800',
        'border-yellow-400', 'bg-yellow-50', 'text-yellow-500', 'hover:bg-yellow-100', 'text-yellow-800',
        'border-red-400', 'bg-red-50', 'text-red-500', 'hover:bg-red-100', 'text-red-800',
        'text-green-400', 'text-yellow-400', 'text-red-400',
        'fadeInUp', 'fadeOutDown',

        '!border-red-300'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
