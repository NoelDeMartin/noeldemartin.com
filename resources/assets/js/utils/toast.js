export function toast(text) {
    const toast = document.createElement('div');
    const message = document.createElement('p');
    toast.classList.add('toast');
    toast.classList.add('opacity-100');
    toast.appendChild(message);
    message.innerText = text;

    // Add
    document.body.appendChild(toast);

    // Remove
    setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
        setTimeout(() => toast.remove(), 500);
    }, 2000);
}
