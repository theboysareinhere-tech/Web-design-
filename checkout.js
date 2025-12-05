document.addEventListener("DOMContentLoaded", () => {

    // Load cart items into summary
    let cart = getCart() || [];
    let orderBox = document.getElementById("order-items");
    let subtotal = 0;

    if (!orderBox) {
        console.error("order-items not found in HTML");
        return;
    }

    // Display each item and calculate subtotal
    cart.forEach(item => {
        let itemTotal = Number(item.priceEach) * Number(item.qty);
        subtotal += itemTotal;

        orderBox.innerHTML += `
            <div class="order-item">
                <strong>${item.name}</strong> (${item.qty})
                <br>
                <small>${item.type}</small> | <small>${item.addon}</small>
                <br>
                <span>$${itemTotal.toFixed(2)}</span>
                <hr>
            </div>
        `;
    });

    // Calculate totals
    document.getElementById("subtotal").innerText = "$" + subtotal.toFixed(2);

    let tax = subtotal * 0.05;
    document.getElementById("tax").innerText = "$" + tax.toFixed(2);

    let shipping = 20;
    let orderTotal = subtotal + tax + shipping;

    document.getElementById("order-total").innerText = "$" + orderTotal.toFixed(2);

    // Handle Order
    document.getElementById("place-order").addEventListener("click", () => {

        // Simple validation
        if (
            !document.getElementById("cust-name").value ||
            !document.getElementById("cust-email").value ||
            !document.getElementById("cust-phone").value ||
            !document.getElementById("cust-address").value
        ) {
            alert("Please fill all required fields.");
            return;
        }

        // Clear cart
        localStorage.removeItem("cart");

        // Redirect to success page
        window.location.href = "order_success.html";
    });
});
