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
                sans: [
                    ["Inter", "sans-serif"],
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            fontWeight: {
                "inter-semilight": 300,
                "inter-normal": 500,
                "inter-md": 900,
            },
            fontSize: {
                "inter-xs": [
                    "0.80rem",
                    {
                        lineHeight: "1rem",
                    },
                ],
                "inter-sm": [
                    "0.875rem",
                    {
                        lineHeight: "1.25rem",
                    },
                ],
                "inter-base": [
                    "0.995rem",
                    {
                        lineHeight: "1.0rem",
                    },
                ],
                "inter-lg": [
                    "1.125rem",
                    {
                        lineHeight: "1.75rem",
                    },
                ],
                "inter-xl": [
                    "1.25rem",
                    {
                        lineHeight: "1.75rem",
                    },
                ],
            },
        },
    },

    plugins: [forms],
};
