import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                "economic-darkgreen": "#008237",
                "economic-lightgreen": "#4da873",
                "economic-red": "#FF0000",
                "economic-darkgray": "#6f6f6f",
                "economic-orange": "#B43C22",
                "economic-green": "#3fb498",
                "economic-lightgray": "#b6c0c6",
                "economic-gri": "#707070",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
