document.addEventListener('DOMContentLoaded', () => {
    const darkbtn = document.getElementById('darkbtn');
    const body = document.body;
    const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

    function enableDarkMode() {
        body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
    }
    function disableDarkMode() {
        body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'disabled');
    }
    if (isDarkMode) {
        enableDarkMode();
        darkbtn.checked = true;
    }
    darkbtn.addEventListener('change', () => {
        if (darkbtn.checked) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    });
});
