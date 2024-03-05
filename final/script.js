// script.js

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

    function openModal() {
        document.getElementById("editModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target === document.getElementById("editModal")) {
            closeModal();
        }
    };

    function editSection(section, currentContent) {
        document.getElementById("editedContent").innerHTML = currentContent;
        openModal();
    }

    function saveChanges() {
        var editedContent = document.getElementById("editedContent").innerHTML;
        closeModal();
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_content.php?page=" + section, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("section=" + section + "&content=" + encodeURIComponent(editedContent));
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert("Content updated successfully!");
            }
        };

        location.reload();

    }

