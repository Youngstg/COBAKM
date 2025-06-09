/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: "jit",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/FE/pages/**/*.{html,js}",
        "./resources/views/components/**/*.blade.php",
        "./resources/views/client/new/**/*.blade.php",
    ],
    theme: {
        fontFamily: {
            inter: ["Inter", "sans-serif"], // Assuming you are using the 'Inter' font
        },
        extend: {
            lineHeight: {
                tighter: "125%",
                normal: "155%",
            },
            colors: {
                white: "#FAFAFA",
                black: "#414141",
                "gasendra-blue": "#189AC5",
                "gasendra-mustard": "#EDBC48",
                "black-100": "#2A2A2A",
                "black-75": "#555555",
                "black-border": "#353535",
                "black-50": "#7F7F7F",
                "black-25": "#AAAAAA",
                "neutral-white": "#F5F7FA",
                "yellow-100": "#EDBC48",
                "yellow-75": "#EDC463",
                "yellow-50": "#EDCC7F",
                "yellow-25": "#EDD49A",
                "orange-100": "#ED6948",
                "orange-75": "#ED7F64",
                "orange-50": "#ED957F",
                "orange-25": "#EDAB9B",
                beranda: "#B48D32",
                organigram: "#3C3B3B",
                "footer-main": "#FAFAFA",
                "blue-75": "#189AC5",
                "gasendra-blue-primary": "#189AC5",
                "gasendra-blue-secondary": "#ECE2AF",
                "gasendra-cream": "#BB9F76",
                primary: "#edbc48",
                "gasendra-yellow-primary": "#EDBC48",
                "gasendra-yellow-secondary": "#D18411",
            },

            boxShadow: {
                "shadow-footer": "-4px 0px 18px 0px rgba(166,166,166,0.30)",
            },

            backgroundImage: {
                logoKM: "url('/resources/FE/assets/LogoKM.svg')",
                "primary-background": "url('/assets/images/mainBg.svg')",
                "eclips-beranda":
                    "url('/resources/FE/assets/Ecplips-beranda.svg')",
                "gear-beranda": "url('/resources/FE/assets/Gear-beranda.svg')",
                "rectangle-beranda":
                    "url('/resources/FE/assets/Rectangle-beranda.svg')",
                "primary-beranda": "url('/resources/FE/assets/mainBg.svg')",
                "jumbotron-kabar": "url('/resources/FE/assets/Bg-kabar.png')",
                "half-eclips":
                    "url('/resources/FE/assets/halfEclips-alur.svg')",
                "cycle-alur": "url('/resources/FE/assets/Cycle-alur.svg')",
                "cycle-profil": "url('/resources/FE/assets/Cycle-profile.svg')",
                "filter-alur": "url('/resources/FE/assets/filter-alur.svg')",
                article: "url('/resources/FE/assets/article.svg')",
                "icon-profil": "url('/resources/FE/assets/icon-profil.svg')",
                "icon-script": "url('/resources/FE/assets/icon_script.svg')",
                "icon-people": "url('/resources/FE/assets/icon-people.svg')",
                "icon-calendar":
                    "url('/resources/FE/assets/icon-calendar.svg')",
                "icon-open": "url('/resources/FE/assets/icon-open.svg')",
                "gear-organigram":
                    "url('/resources/FE/assets/Gear-organigram.svg')",
                "circle-organigram":
                    "url('/resources/FE/assets/Circle-organigram.svg')",

                jumbotron: "url('/assets/images/new/bgJumbotron.png')",
                "gradient-1":
                    "linear-gradient(73deg, #95CAD6 -0.41%, rgba(82, 182, 204, 0.55) 51.1%, rgba(124, 211, 230, 0.27) 83.84%, rgba(255, 255, 255, 0.00) 114.86%)",
                visi: "url('/resources/FE/assets/new/bgVisi.png')",
                "visi-mobile":
                    "url('/resources/FE/assets/new/visi-mobile.svg')",
                "misi-mobile":
                    "url('/resources/FE/assets/new/misi-mobile.svg')",
                misi: "url('/resources/FE/assets/new/bgMisi.png')",
            },
            screens: {
                1200: "1200px",
                1000: "1000px",
                900: "900px",
                800: "800px",
                700: "700px",
                600: "600px",
                425: "425px",
                400: "400px",
            },
        },
    },

    plugins: [],
};
