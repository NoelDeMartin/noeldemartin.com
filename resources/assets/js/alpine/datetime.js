import Alpine from 'alpinejs';

const FORMATS = {
    'date-short': {
        // "M d, Y" in PHP
        dateStyle: 'medium',
    },
    date: {
        // "F d, Y" in PHP
        dateStyle: 'long',
    },
    time: {
        // "H:i" in PHP
        timeStyle: 'short',
    },
    month: {
        // "F Y" in PHP
        year: 'numeric',
        month: 'long',
    },
    'month-short': {
        // "M Y" in PHP
        year: 'numeric',
        month: 'short',
    },
    'datetime-short': {
        // "M d, Y H:i" in PHP
        dateStyle: 'medium',
        timeStyle: 'short',
    },
    datetime: {
        // "F d, Y H:i" in PHP
        dateStyle: 'long',
        timeStyle: 'short',
    },
};

const timezoneOffset = new Date().getTimezoneOffset() * 60000;
const formatters = Object.entries(FORMATS).reduce(
    (others, [name, options]) => ({
        [name]: new Intl.DateTimeFormat('en-US', options),
        ...others,
    }),
    {},
);

Alpine.directive('datetime', (el, { value, expression }, { evaluate }) => {
    const localDate = new Date(evaluate(expression) * 1000 - timezoneOffset);
    const format = value ?? 'datetime';
    const formatter = formatters[format];

    el.textContent = formatter.format(localDate);
});
