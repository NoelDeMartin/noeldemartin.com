import Alpine from 'alpinejs';

const FORMATS = {
    date: {
        // "F d, Y" in PHP
        dateStyle: 'long',
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
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    },
    datetime: {
        // "F d, Y H:i" in PHP
        month: 'long',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    },
};

const formatters = Object.entries(FORMATS).reduce(
    (others, [name, options]) => ({
        [name]: new Intl.DateTimeFormat('en-US', options),
        ...others,
    }),
    {},
);

Alpine.directive('datetime', (el, { value, expression }, { evaluate }) => {
    const localDate = new Date(evaluate(expression) * 1000);
    const format = value ?? 'datetime';
    const formatter = formatters[format];

    el.textContent = formatter.format(localDate);
});
