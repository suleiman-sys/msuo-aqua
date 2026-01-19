<?php
// Linda page (kama una auth)
require "auth.php";
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Admin – Ongeza Bidhaa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      padding: 40px;
    }

    .container {
      max-width: 520px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #0b5ed7;
    }

    .form-group {
      margin-bottom: 16px;
    }

    input,
    textarea,
    select,
    button {
      width: 100%;
      padding: 12px;
      font-size: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    textarea {
      resize: vertical;
    }

    button {
      background: #0b5ed7;
      color: #fff;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background: #084298;
    }

    .msg {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
    }

    .logout {
      text-align: right;
      margin-bottom: 10px;
    }

    .logout a {
      font-size: 14px;
      color: #dc2626;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="logout">
    <a href="logout.php">🚪 Logout</a>
  </div>

  <h2>➕ Ongeza Bidhaa</h2>

  <!-- 🔴 HAKUNA action, HAKUNA method -->
  <form id="productForm" enctype="multipart/form-data">

    <div class="form-group">
      <input type="text" name="name" placeholder="Jina la bidhaa" required>
    </div>

    <div class="form-group">
      <textarea
        name="description"
        placeholder="Maelezo ya bidhaa..."
        rows="4"
        required
      ></textarea>
    </div>

    <div class="form-group">
      <select name="category" required>
        <option value="">-- Chagua Category --</option>
        <option value="samaki">Samaki</option>
        <option value="aquarium">Aquarium</option>
        <option value="kuku">Kuku</option>
      </select>
    </div>

    <div class="form-group">
      <input type="number" name="price" placeholder="Bei (Tsh)" required>
    </div>

    <div class="form-group">
      <input type="text" name="unit" placeholder="Unit (pair, piece)" required>
    </div>

    <div class="form-group">
      <select name="badge">
        <option value="">-- Hakuna badge --</option>
        <option value="mpya">Mpya</option>
        <option value="maarufu">Maarufu</option>
        <option value="offer">Offer</option>
      </select>
    </div>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">


    <div class="form-group">
      <input type="file" name="image" accept="image/*" required>
    </div>

    <button type="submit">Hifadhi Bidhaa</button>
  </form>

  <div class="msg" id="msg"></div>
</div>

<script>
const form = document.getElementById("productForm");
const msg  = document.getElementById("msg");

form.addEventListener("submit", async (e) => {
  e.preventDefault(); // 🔥 HII NDIO FIX YA KUZUIA DOUBLE INSERT

  msg.textContent = "Inahifadhi...";
  msg.style.color = "#333";

  const formData = new FormData(form);

  try {
    const res = await fetch("../backend/api/add-product.php", {
      method: "POST",
      body: formData
    });

    const result = await res.json();

    if (result.success) {
      msg.style.color = "green";
      msg.textContent = "✅ Bidhaa imeongezwa kikamilifu";
      form.reset();
    } else {
      msg.style.color = "red";
      msg.textContent = result.error || "❌ Kuna tatizo";
    }
  } catch (err) {
    msg.style.color = "red";
    msg.textContent = "❌ Server error";
    console.error(err);
  }
});
</script>

</body>
</html>
