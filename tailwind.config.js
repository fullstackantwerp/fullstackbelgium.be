module.exports = {
    important: true,
    theme: {
        borderColor: theme => ({
            default: theme('colors.gray.400', 'currentColor'),
            ...theme('colors'),
        }),
        extend: {
            colors: {
                transparent: 'transparent',
                black: 'var(--black)',
                white: 'var(--white)',
                gray: {
                    200: 'var(--gray-200)',
                    300: 'var(--gray-300)',
                    400: 'var(--gray-400)',
                    500: 'var(--gray-500)',
                    600: 'var(--gray-600)',
                    700: 'var(--gray-700)',
                    800: 'var(--gray-800)',
                },
                belgium: 'var(--belgium)',
                antwerp: 'var(--antwerp)',
                brussels: 'var(--brussels)',
                ghent: 'var(--ghent)',
            },
            fontFamily: {
                sans: ['interstate', 'system-ui', 'sans-serif'],
            },
            fontSize: {
                '2xs': '.625rem',
            },
            boxShadow: {
                default: '0 2px 4px 0 rgba(0,0,0,0.10)',
                md: '0 4px 8px 0 rgba(0,0,0,0.05), 0 2px 4px 0 rgba(0,0,0,0.03)',
                lg: '0 15px 30px 0 rgba(0,0,0,0.05), 0 5px 15px 0 rgba(0,0,0,0.03)',
            },
            maxWidth: {
                'min-content': 'min-content',
            },
        },
    },
};
