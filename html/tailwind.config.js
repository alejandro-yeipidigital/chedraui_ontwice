module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            backgroundImage: theme => ({
                'btn': "linear-gradient(220deg, rgba(207,175,78,1) 0%, rgba(244,225,119,1) 50%, rgba(167,116,14,1) 100%)",
                'banner': "url('../images/banner.jpg')",
                'yellow-gradient': "linear-gradient(180deg, rgba(223,190,84,1) 0%, rgba(199,155,42,1) 50%)",
                'red-gradient': "linear-gradient(0deg, rgba(126,11,1,1) 0%, rgba(213,102,3,1) 100%)",
                
            }),
            colors: {
                black: '#000',
                white: '#fff',
                gray: '#676767',
                
                red: '#ff3555',
                primary: '#09514e',
                primaryOpacity: '#09514eb3',
                green: '#127567',
                lightGreen: '#229c98',
                bgColorOrange: '#ffa040',
                bgColorYellow: '#ffec7f',
                bgHeader: '#229c98',

                yellow: '#fade88',
                facebook: '#3b5998'
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: '1rem',
                    sm: '1rem',
                    lg: '2rem',
                    xl: '2rem',
                    '2xl': '2rem',
                }
            },
            fontFamily: {
                'sans': ['"Helvetica LT Std"', 'Verdana', 'sans-serif'],
                'montserrat': ['Montserrat', 'Verdana']
            },
        },
        letterSpacing: {
            tightest: '-.075em',
            tight: '-.025em',
            wide: '.05em',
            wider: '.075em',
            widest: '.15em',
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
