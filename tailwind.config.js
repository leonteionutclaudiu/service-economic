/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "economic-darkgreen": "#008237",
                "economic-lightgreen": "#00E500",
                "economic-red": "#FF0000",
                "economic-darkgray": "#6f6f6f",
                "economic-orange": "#B43C22",
                "economic-green": "#3fb498",
                "economic-lightgray": "#b6c0c6",
                "economic-gri": "#707070",
            },
        },
        plugins: [],
    },
};
