// Product Database
const products = {
  "ECU Units": {
    basePrice: 120,
    image: "images/ecu-unit.jpg",
    types: {
      "OEM ECU": 0,
      "Refurbished ECU": 40,
      "Standalone ECU": 180,
      "Piggyback ECU": 90
    },
    addons: {
      "No Add-on": 0,
      "ECU Unlock Service": 50,
      "Bench Connection Kit": 35,
      "Pre-programming": 80
    }
  },

  "Tuning Tools": {
    basePrice: 220,
    image: "images/tuning-tools.jpg",
    types: {
      "KESS3": 0,
      "K-TAG": 75,
      "Autotuner": 140,
      "PCMFlash": 60
    },
    addons: {
      "No Add-on": 0,
      "OBD Cable Kit": 20,
      "Boot Cable Set": 35,
      "Virtual Credits Pack": 50
    }
  },

  "Bench Tools": {
    basePrice: 75,
    image: "images/bench-tools.jpg",
    types: {
      "Basic BDM Frame": 0,
      "Pro BDM Frame": 60,
      "Breakout Box": 45,
      "Power Supply Unit": 90
    },
    addons: {
      "No Add-on": 0,
      "Probes Set": 25,
      "ECU Stand": 30,
      "Micro Solder Kit": 40
    }
  },

  // --- New Product 1 ---
  "ECU Accessories": {
    basePrice: 40,
    image: "images/ecu_accessories.webp",
    types: {
      "Cables": 0,
      "Connectors": 10,
      "Adapters": 20
    },
    addons: {
      "No Add-on": 0,
      "Extra Pack": 15
    }
  },

  // --- New Product 2 ---
  "Software Licenses": {
    basePrice: 150,
    image: "images/software_licenses.webp",
    types: {
      "ECU Remap": 0,
      "Update License": 50
    },
    addons: {
      "No Add-on": 0,
      "Extended Support": 30
    }
  }
};

let selectedProduct = null;

// Load product from URL
const params = new URLSearchParams(window.location.search);
let productName = params.get("product");

if (products[productName]) {
  selectedProduct = products[productName];

  document.getElementById("product-title").innerText = "Customize: " + productName;
  document.getElementById("product-image").src = selectedProduct.image;

  const typeSelect = document.getElementById("type-select");
  Object.entries(selectedProduct.types).forEach(([name, price]) => {
    typeSelect.innerHTML += `<option value="${price}">${name} (+$${price})</option>`;
  });

  const addonSelect = document.getElementById("addon-select");
  Object.entries(selectedProduct.addons).forEach(([name, price]) => {
    addonSelect.innerHTML += `<option value="${price}">${name} (+$${price})</option>`;
  });
}

// Live Price Update
function updatePrice() {
  if (!selectedProduct) return;

  let type = Number(document.getElementById("type-select").value);
  let addon = Number(document.getElementById("addon-select").value);
  let qty = Number(document.getElementById("qty").value);

  let total = (selectedProduct.basePrice + type + addon) * qty;

  document.getElementById("total-price").innerText = "$" + total.toFixed(2);
}

document.querySelectorAll("select, input").forEach(el => {
  el.addEventListener("change", updatePrice);
});

updatePrice();

// Add to Cart
document.getElementById("add-cart-btn").addEventListener("click", () => {
  if (!selectedProduct) return;

  const productName = document.getElementById("product-title").textContent.replace("Customize: ", "");
  const productImage = document.getElementById("product-image").src;

  const typeSelect = document.getElementById("type-select");
  const addonSelect = document.getElementById("addon-select");
  const qty = Number(document.getElementById("qty").value);

  const typeText = typeSelect.options[typeSelect.selectedIndex].text;
  const addonText = addonSelect.options[addonSelect.selectedIndex].text;

  const base = selectedProduct.basePrice;
  const typePrice = Number(typeSelect.value);
  const addonPrice = Number(addonSelect.value);

  const totalItemPrice = (base + typePrice + addonPrice) * qty;

  const item = {
    name: productName,
    image: productImage,
    type: typeText,
    addon: addonText,
    qty: qty,
    priceEach: base + typePrice + addonPrice,
    total: totalItemPrice
  };

  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.push(item);
  localStorage.setItem("cart", JSON.stringify(cart));

  alert("Item added to cart!");
});

// Checkout Button
document.getElementById("checkout-btn").addEventListener("click", () => {
  window.location.href = "checkout.php";
});