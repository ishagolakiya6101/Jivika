/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        "weather-primary": "#0075ff",
        "weather-secondary": "#F6F5FB",
        "gray": "#00000024"
      }
    },
  },
  plugins: [],
}

