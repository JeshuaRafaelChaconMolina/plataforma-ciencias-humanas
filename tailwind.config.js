/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#eef4ff',
                    100: '#d9e6ff',
                    200: '#b3ccff',
                    300: '#80abff',
                    400: '#4d82ff',
                    500: '#1f5cf0',
                    600: '#0f3fc7',
                    700: '#0c329e',
                    800: '#0a2879',
                    900: '#081e5c',
                },
                accent: {
                    300: '#ffe27a',
                    400: '#ffd23f',
                    500: '#ffc107',
                    600: '#e0a500',
                },
            },
            fontFamily: {
                sans: ['"Inter"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};