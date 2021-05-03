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
            },
            container: {
                center: true
            },
            fontFamily: {
                'sans': ['"Helvetica LT Std"', 'Verdana', 'sans-serif'],
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