/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.{js,ts,jsx,tsx}",
    "./components/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: "#f0f7f4",
          100: "#d9ebe2",
          200: "#b5d7c6",
          300: "#86bca4",
          400: "#5a9d80",
          500: "#3d8268",
          600: "#2d6852",
          700: "#1F4D3A",
          800: "#1a3f30",
          900: "#163429",
          950: "#0b1d17",
        },
      },
      fontFamily: {
        sans: ["var(--font-poppins)", "system-ui", "sans-serif"],
      },
    },
  },
  plugins: [],
};
