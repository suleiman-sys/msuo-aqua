<?php
require_once "../config/db.php";

// Hakikisha ni POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  die("Method not allowed");
}

$id = (int)$_POST['id'];

// 1️⃣ Pata picha ya bidhaa
$stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
  die("Product not found");
}

// 2️⃣ Futa picha (kama ipo)
if (!empty($product['image'])) {
  $imagePath = "../../images/" . $product['image'];
  if (file_exists($imagePath)) {
    unlink($imagePath);
  }
}

// 3️⃣ Futa bidhaa DB
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// 4️⃣ Rudi admin products
header("Location: /msuo-aqua/admin/products.php");
exit;
