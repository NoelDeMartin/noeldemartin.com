module.exports = {
    theme: {
        colors: {
            'transparent': 'transparent',

            'white': '#ffffff',

            'black-light': '#4a4a4a',
            'black': '#22292f',
            'black-dark': '#000000',

            'grey-lightest': '#f8fafc',
            'grey-lighter': '#f1f5f8',
            'grey-light': '#dae1e7',
            'grey': '#b8c2cc',
            'grey-dark': '#8795a1',
            'grey-darker': '#606f7b',
            'grey-darkest': '#3d4852',

            'jade-lighter': '#bdead9',
            'jade': '#00af6f',
            'jade-darker': '#007047',

            'rss': '#ff6600',

            'blue-lightest': '#eff8ff',
            'blue-lighter': '#bcdefa',
            'blue-light': '#6cb2eb',
            'blue': '#3490dc',
            'blue-dark': '#2779bd',
            'blue-darker': '#266193',
            'blue-darkest': '#12283a',

            'yellow-lighter': '#faf089',
            'yellow-darker': '#b7791f',
            'yellow-darkest': '#744210',

            'error': '#f44336',

            'overlay': 'rgba(0, 0, 0, 0.075)',
            'overlay-dark': 'rgba(0, 0, 0, 0.7)',
        },
        fontFamily: {
            'ubuntu': [
                'Ubuntu',
                'sans-serif',
            ],
            'mono': [
                'Ubuntu Mono',
                'sans-serif',
            ],
        },
        borderColor: theme => ({
            ...theme('colors'),
            default: theme('colors.grey-light', 'currentColor'),
        }),
        extend: {
            minWidth: theme => ({
                '10': theme('spacing.10'),
                'sidebar': '65vw',
            }),
            maxWidth: {
                'readable': '640px',
                'content': '900px',
            },
        },
    },
    variants: {
        borderColor: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'visited'],
    },
};
