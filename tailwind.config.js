/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  darkMode: 'class',
  safelist: [
    'text-red-800',
    'text-blue-800',
    'border-red-300',
    'border-blue-300',
    'bg-red-50',
    'bg-blue-50',
    'text-red-400',
    'text-blue-400',
  ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['"Proxima Nova"', ...defaultTheme.fontFamily.sans],
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],

}
