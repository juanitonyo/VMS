/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily:{
        'poppins' : ['Poppins']
      },
      backgroundImage: {
        'background': "url('/Visitor_Homepage_Assets/background.jpg')"
      }
    },
  },
  plugins: [],
}
