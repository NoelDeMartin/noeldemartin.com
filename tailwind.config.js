module.exports = {
    theme: {
        colors: {
            'transparent': 'transparent',

            'black-light': '#4a4a4a',

            'black': '#22292f',
            'grey-darkest': '#3d4852',
            'grey-darker': '#606f7b',
            'grey-dark': '#8795a1',
            'grey': '#b8c2cc',
            'grey-light': '#dae1e7',
            'grey-lighter': '#f1f5f8',
            'grey-lightest': '#f8fafc',
            'white': '#ffffff',

            'jade-darker': '#10714d',
            'jade': '#00a86b',
            'jade-lighter': '#a4ffde',

            'blue-darkest': '#12283a',
            'blue-darker': '#266193',
            'blue-dark': '#2779bd',
            'blue': '#3490dc',
            'blue-light': '#6cb2eb',
            'blue-lighter': '#bcdefa',
            'blue-lightest': '#eff8ff',

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
            maxWidth: theme => ({
                'readable': '640px',
                'content': '900px',
            }),
            minHeight: {
                'editor': '25rem',
            },
        },
    },
    variants: {
        borderColor: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'visited'],
    },
};
