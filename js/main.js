/*************************************************
 * MSUO AQUA & POULTRY – FRONTEND JS (STABLE)
 *************************************************/

let PRODUCTS = [];
let currentCategory = "all";
let currentSearch = "";

const grid = document.querySelector("#productGrid");
const searchInput = document.querySelector("#searchInput");
const filterButtons = document.querySelectorAll(".filter-btn");

/* LOAD PRODUCTS */
async function loadProducts() {
  try {
    const res = await fetch("backend/api/products.php");
    if (!res.ok) throw new Error("fetch");
    PRODUCTS = await res.json();
    renderProducts();
  } catch (e) {
    if (grid) {
      grid.innerHTML = `
        <div class="empty-state">
          <h3>❌ Hitilafu ya mtandao</h3>
          <p>Jaribu tena baadae</p>
        </div>`;
    }
  }
}

/* RENDER */
function renderProducts() {
  if (!grid) return;
  grid.innerHTML = "";

  const filtered = PRODUCTS.filter(p => {
    const c = currentCategory==="all" || p.category===currentCategory;
    const s = p.name.toLowerCase().includes(currentSearch.toLowerCase());
    return c && s;
  });

  if (!filtered.length) {
    grid.innerHTML = `<div class="empty-state"><h3>Hakuna bidhaa</h3></div>`;
    return;
  }

  filtered.forEach(p => {
    const img = p.image ? p.image : "images/no-image.png";
    const card = document.createElement("div");
    card.className = "product-card";
    card.innerHTML = `
      ${p.badge ? `<span class="badge ${p.badge}">${p.badge.toUpperCase()}</span>` : ""}
      <img src="${img}" alt="${p.name}">
      <h3>${p.name}</h3>
      <p class="price">Tsh ${Number(p.price).toLocaleString()}</p>
      <button class="btn view-product" data-id="${p.id}">👁️ Tazama Bidhaa</button>
    `;
    grid.appendChild(card);
  });
}

/* SEARCH */
if (searchInput) {
  searchInput.addEventListener("input", e => {
    currentSearch = e.target.value;
    renderProducts();
  });
}

/* FILTER */
filterButtons.forEach(b=>{
  b.addEventListener("click", ()=>{
    filterButtons.forEach(x=>x.classList.remove("active"));
    b.classList.add("active");
    currentCategory = b.dataset.filter;
    renderProducts();
  });
});

/* MODAL HANDLER (ALL PAGES) */
document.addEventListener("click", e => {
  const btn = e.target.closest(".view-product");
  if (!btn) return;

  const id = parseInt(btn.dataset.id);
  const p = PRODUCTS.find(x=>x.id===id);
  if (!p) return;

  document.getElementById("modalImage").src = p.image || "images/no-image.png";
  document.getElementById("modalName").textContent = p.name;
  document.getElementById("modalDesc").textContent = p.description || "Hakuna maelezo";
  document.getElementById("modalPrice").textContent = "Tsh " + Number(p.price).toLocaleString();

  const msg = `Habari, nahitaji ${p.name} (${p.unit}) bei Tsh ${Number(p.price).toLocaleString()}`;
  document.getElementById("modalWhatsapp").href =
    "https://wa.me/255769514161?text=" + encodeURIComponent(msg);

  document.getElementById("productModal").classList.remove("hidden");
});

/* MODAL CLOSE */
document.addEventListener("DOMContentLoaded", ()=>{
  const modal = document.getElementById("productModal");
  const close = document.getElementById("closeModal");
  if (!modal || !close) return;

  close.onclick = ()=> modal.classList.add("hidden");
  modal.onclick = e => { if (e.target===modal) modal.classList.add("hidden"); };
  document.addEventListener("keydown", e => {
    if (e.key==="Escape") modal.classList.add("hidden");
  });

  loadProducts();
});
