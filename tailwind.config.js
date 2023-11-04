import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            gridTemplateColumns: {
                autoLayout: "repeat(auto-fit, minmax(210px,1fr))",
            },
            gridTemplateRows: {
                fit: "auto auto 1fr auto",
            },
            screens: {
                mdx: "790px",
            },
        },
    },

    plugins: [forms],
};
