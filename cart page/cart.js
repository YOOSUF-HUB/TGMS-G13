// Removing items from the cart
document.querySelectorAll('.remove-item').forEach(item => {
    item.addEventListener('click', function() {
        this.parentElement.remove();
        updateTotal();
    });
});

// Updating the total after removing an item
function updateTotal() {
    // Calculate the updated total amount
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        let price = parseFloat(item.querySelector('.item-details span:last-child').innerText.replace('Rs. ', ''));
        total += price;
    });
    
    document.querySelector('.order-summary p:nth-child(2) span').innerText = 'Rs. ' + total;
    document.querySelector('.order-summary p:nth-child(3) span').innerText = 'Rs. ' + (total + 5000); // Including shipping fee
}
