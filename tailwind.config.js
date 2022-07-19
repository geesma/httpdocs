module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  theme: {
    extend: {
      colors: {
        'primary-from': 'rgb(186,175,149)',
        'primary-to': '#756e5e',
        primary: '#756e5e'
      },
      spacing: {
        128: '30rem'
      }
    }
  },
  plugins: []
}
