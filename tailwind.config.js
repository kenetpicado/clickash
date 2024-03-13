import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#2a6049",
                'primary-dark': "#1f4a36",
                basic: "#535353",
                card: "#ebf0ee",
                'green-pea': {
                    '50': '#f1f8f4',
                    '100': '#ddeee3',
                    '200': '#bdddc9',
                    '300': '#91c4a9',
                    '400': '#62a583',
                    '500': '#418866',
                    '600': '#2f6c50',
                    '700': '#2a6049',
                    '800': '#204536',
                    '900': '#1b392d',
                    '950': '#0e2019',
                },

            },
            fontSize: {
                'xxs': '0.6rem'
            }
        },
    },

    plugins: [forms, typography],
};
