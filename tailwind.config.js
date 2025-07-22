import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        "badge",
        "badge-info",
        "badge-success",
        "badge-warning",
        "gap-2",
        "text-md",
        "font-semibold",
        "text-red-400",
        "text-base-100",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "lynx-white": "#f7f7f5",
            },
        },
    },

    plugins: [forms, daisyui],
    daisyui: {
        themes: true,
        base: true,
        utils: true,
        logs: true,
    },
};
