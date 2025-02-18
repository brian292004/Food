document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM Loaded - Script Running"); // Kiểm tra xem script có chạy không

    const translations = {
        en: {
            search: "Search",
            home: "Home",
            dashboard: "Dashboard",
            notifications: "Notifications",
            favorites: "Favorites",
            files: "Files",
            dark_mode: "Dark Mode",
            language: "Language",
            sign_up: "Sign Up",
            sign_in: "Sign In",
            featured_categories: "Featured Categories",
            product_catalog: "Product catalog",
        },
        vi: {
            product_catalog: "Danh mục sản phẩm",
            featured_categories: "Danh mục nổi bật",
            search: "Tìm kiếm",
            home: "Trang chủ",
            dashboard: "Bảng điều khiển",
            notifications: "Thông báo",
            favorites: "Yêu thích",
            files: "Tệp tin",
            dark_mode: "Chế độ tối",
            language: "Ngôn ngữ",
            sign_up: "Đăng ký",
            sign_in: "Đăng nhập"
        }
    };

    function applyLanguage(lang) {
        console.log("Changing language to:", lang); // Kiểm tra xem có chạy không
        localStorage.setItem("language", lang);
        document.documentElement.lang = lang;

        document.querySelectorAll("[data-lang-key]").forEach((element) => {
            const key = element.getAttribute("data-lang-key");
            if (translations[lang] && translations[lang][key]) {
                element.textContent = translations[lang][key];
            }
        });

        console.log("Language set in localStorage:", localStorage.getItem("language")); // Kiểm tra giá trị đã lưu
    }

    // Lấy ngôn ngữ đã lưu hoặc mặc định là "en"
    const savedLanguage = localStorage.getItem("language") || "en";
    applyLanguage(savedLanguage);

    // Xử lý sự kiện khi nhấn vào nút chuyển đổi ngôn ngữ (Chặn reload)
    document.querySelector(".toggle-language").addEventListener("click", function (event) {
        event.preventDefault(); // ✅ Chặn reload trang
        console.log("Language button clicked!"); // Kiểm tra xem click có hoạt động không
        const currentLang = localStorage.getItem("language") || "en";
        const newLang = currentLang === "en" ? "vi" : "en";
        applyLanguage(newLang);
    });
});
