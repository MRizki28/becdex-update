const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
	content: [
		'./index.php',
        './pages/**/*.{php,js}',
        './parts/**/*.{php,js}'
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Epilogue', ...defaultTheme.fontFamily.sans],
			},
		},
	},
	plugins: [],
};