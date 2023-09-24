document.addEventListener('DOMContentLoaded', () => {
    initApp();
});

function initApp() {
    searchDate();
}

function searchDate() {
    const dateInput = document.querySelector('#date');
    dateInput.addEventListener('input', (e) => {
        const selectedDate = e.target.value;

        window.location = `?date=${selectedDate}`;
    });
}