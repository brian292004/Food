document.addEventListener('DOMContentLoaded', function () {
    const foodCards = document.querySelectorAll('.food-list-card');
    foodCards.forEach(card => {
        card.addEventListener('click', function () {
            const foodId = this.getAttribute('data-id');
            window.location.href = `/food/${foodId}`;
        });
    });
});