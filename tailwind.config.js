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
        "form-control",

        "label",
        "label-text",

        "badge",
        "badge-info",
        "badge-success",
        "badge-ghost",
        "badge-warning",
        "badge-error",

        "text-red-400",
        "text-base-100",
        "text-base-200",
        "text-error",
        "text-info",

        "textarea",
        "textarea-bordered",
        "textarea-xs",

        "btn",
        "btn-sm",
        "btn-square",
        "btn-outline",
        "btn-error",
        "btn-ghost",

        "input",
        "input-bordered",
        "input-sm",

        "dropdown",
        "dropdown-bottom",
        "dropdown-end",
        "dropdown-content",
        "menu",

        "bg-base-100",

        "border-base-200"
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
