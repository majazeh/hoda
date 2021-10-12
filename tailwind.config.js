const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    screens: {
      'xs': '475px',
      ...defaultTheme.screens,
    },
    extend: {
      colors: {
        brand: {
          DEFAULT: '#A32900'
        },
        orange: colors.orange,
        lime: colors.lime,
        cyan: colors.cyan,
        blue: colors.sky
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
