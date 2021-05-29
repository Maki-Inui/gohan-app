const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'regal-orange': '#E85A25',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                body: [
                    'ヒラギノ角ゴシック',
                    'メイリオ',
                    'Meiryo',
                    'YuGothic',
                    'Yu Gothic',
                    'ＭＳ Ｐゴシック',
                    'MS PGothic'
                ]
            },
        },

        fontSize: {
            '2xl': ['24px', {
              letterSpacing: '-0.01em',
            }],
            // Or with a default line-height as well
            '3xl': ['32px', {
              letterSpacing: '-0.02em',
              lineHeight: '40px',
            }],
          }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
