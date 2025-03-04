document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const buyPrice = document.getElementById('buy-price');
    const basePrice = {{ $food->food_price }};
    
    function updatePrice() {
        const quantity = parseInt(quantityInput.value);
        buyPrice.textContent = (basePrice * quantity) + "đ";
    }

    window.changeQuantity = function (change) {
        let quantity = parseInt(quantityInput.value) + change;
        if (quantity < 1) quantity = 1;
        quantityInput.value = quantity;
        updatePrice();
    };

    window.changeAddress = function () {
        let newAddress = prompt("Nhập địa chỉ mới:");
        if (newAddress) {
            document.getElementById('user-address').textContent = newAddress;
        }
    };

    window.toggleDropdown = function () {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    };

    window.selectPayment = function (method) {
        let text = method === "cod" ? "Thanh toán khi nhận hàng"
            : method === "bank" ? "Chuyển khoản ngân hàng"
            : "Ví MoMo";
        document.querySelector('.dropdown-btn').textContent = text;
        document.querySelector('.dropdown-menu').classList.remove('show');
    };
});
