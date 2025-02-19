document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM Loaded - Script Running");

    const toggleDarkMode = document.querySelector(".toggle-dark-mode");
    const toggleLanguage = document.querySelector(".toggle-language");

    // 🌓 Dark Mode - Không reload
    function applyTheme(theme) {
        document.body.classList.remove("light", "dark");
        document.body.classList.add(theme);
        localStorage.setItem("theme", theme);
    }

    toggleDarkMode.addEventListener("click", function (event) {
        event.preventDefault();  // ✅ Chặn reload
        const newTheme = document.body.classList.contains("dark") ? "light" : "dark";
        applyTheme(newTheme);
    });

    applyTheme(localStorage.getItem("theme") || "light");
});