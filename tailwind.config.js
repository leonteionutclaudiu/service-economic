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
                "radacini-darkblue": "#004994",
                "radacini-lightblue": "#007bc2",
                "radacini-darkgray": "#6f6f6f",
                "radacini-orange": "#e45d50",
                "radacini-green": "#3fb498",
                "radacini-lightgray": "#b6c0c6",
                "radacini-pur": "#5E0035",
                "radacini-gri": "#707070",
            },
        },
        plugins: [],
    },
};
