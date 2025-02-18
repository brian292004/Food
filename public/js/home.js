document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    const slides = document.querySelectorAll("#bannerCarousel .slide");
    const totalSlides = slides.length;
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 3000);
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    slides.forEach((slide) => {
        slide.addEventListener("mouseover", stopSlideShow);
        slide.addEventListener("mouseout", startSlideShow);
    });

    startSlideShow();
    showSlide(currentIndex);
});

document.addEventListener("DOMContentLoaded", function () {
    const featuredProducts = document.getElementById("featured-products");
    const productCards = document.querySelectorAll(".product-card");
    const iconLeft = document.querySelector(".icon-left");
    const iconRight = document.querySelector(".icon-right");

    function updateIcons() {
        const containerWidth = featuredProducts.offsetWidth;
        const cardWidth = 140; // Width of each card
        const maxVisibleCards = Math.floor(containerWidth / cardWidth);

        productCards.forEach((card, index) => {
            if (index < maxVisibleCards) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });

        if (productCards.length > maxVisibleCards) {
            iconLeft.style.opacity = 1;
            iconRight.style.opacity = 1;
        } else {
            iconLeft.style.opacity = 0.5;
            iconRight.style.opacity = 0.5;
        }
    }

    window.addEventListener("resize", updateIcons);
    updateIcons();
});
document.addEventListener("DOMContentLoaded", function () {
    function updateVisibleProducts() {
        const container = document.getElementById("featured-products");
        const totalProducts = parseInt(container.getAttribute("data-total"), 10);
        const cardWidth = document.querySelector(".category-card")?.offsetWidth || 140; // Mặc định 140px nếu không tìm thấy

        const sidebarWidth = 60; // Sidebar cố định
        const gapBetweenCards = 10; // Khoảng cách giữa các card

        // Tính toán lại chiều rộng thực tế của container
        const availableWidth = window.innerWidth - sidebarWidth;
        const maxVisible = Math.floor((availableWidth) / (cardWidth + gapBetweenCards)); // Làm tròn xuống

        console.log("📏 Chiều rộng màn hình:", window.innerWidth);
        console.log("📦 Kích thước card:", cardWidth);
        console.log("📐 Chiều rộng khả dụng (đã trừ sidebar):", availableWidth);
        console.log("🔢 Số sản phẩm tối đa có thể hiển thị:", maxVisible);
        console.log("📊 Tổng sản phẩm có sẵn:", totalProducts);

        let visibleCount = 0;
        document.querySelectorAll(".category-card").forEach((card, index) => {
            if (index < maxVisible) {
                card.style.display = "block";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        console.log("👀 Số sản phẩm đang hiển thị:", visibleCount);
    }

    // Gọi hàm khi load trang và khi resize cửa sổ
    updateVisibleProducts();
    window.addEventListener("resize", updateVisibleProducts);
});




