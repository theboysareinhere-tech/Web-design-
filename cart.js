// =====================
// CART SYSTEM (CLEAN + FIXED)
// =====================

// Load cart
function getCart() {
    return JSON.parse(localStorage.getItem("cart")) || [];
}

// Save cart
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();
}

// Add item to cart
function addToCart(item) {
    let cart = getCart();

    // Check for duplicate item (same name, type, addon)
    let existing = cart.find(
        i => i.name === item.name &&
             i.type === item.type &&
             i.addon === item.addon
    );

    if (existing) {
        existing.qty += item.qty;
        existing.total = existing.qty * existing.priceEach;
    } else {
        cart.push(item);
    }

    saveCart(cart);
}

// Remove item
function removeCartItem(index) {
    let cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    loadCartPage();
}

// Update quantity
function updateQty(index, qty) {
    qty = parseInt(qty);
    let cart = getCart();

    if (qty < 1) qty = 1;

    cart[index].qty = qty;
    cart[index].total = cart[index].priceEach * qty;

    saveCart(cart);
    loadCartPage();
}

// Update cart badge
function updateCartCount() {
    let cart = getCart();
    let count = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById("cart-count");
    if (badge) badge.textContent = count;
}

// Load cart page
function loadCartPage() {
    const container = document.getElementById("cart-items");
    const totalElement = document.getElementById("cart-total");

    if (!container || !totalElement) return;

    let cart = getCart();
    container.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
        const div = document.createElement("div");
        div.classList.add("cart-item");

        div.innerHTML = `
            <img src="${item.image}" class="cart-img">

            <div class="cart-info">
                <h3>${item.name}</h3>
                <p>Type: ${item.type}</p>
                <p>Add-on: ${item.addon}</p>
                <p>Unit Price: $${item.priceEach.toFixed(2)}</p>
            </div>

            <div class="cart-actions">
                <input type="number" min="1" value="${item.qty}" 
                    onchange="updateQty(${index}, this.value)">
                
                <span class="item-total">
                    $${(item.priceEach * item.qty).toFixed(2)}
                </span>

                <button class="remove-btn" onclick="removeCartItem(${index})">
                    Remove
                </button>
            </div>
        `;

        container.appendChild(div);
        total += item.priceEach * item.qty;
    });

    totalElement.textContent = "$" + total.toFixed(2);
}

// Initialize badge
updateCartCount();
