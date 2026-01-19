<?php
header("Content-Type: application/json");
require_once "../config/db.php";

// Allow GET only
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
  http_response_code(405);
  echo json_encode(["error" => "Method not allowed"]);
  exit;
}

try {
  $stmt = $pdo->prepare("
    SELECT id, name, description, category, price, unit, badge, image
    FROM products
    ORDER BY id DESC
    LIMIT 100
  ");
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $data = [];
  foreach ($rows as $p) {
    $data[] = [
      "id" => (int)$p["id"],
      "name" => htmlspecialchars($p["name"], ENT_QUOTES, "UTF-8"),
      "description" => htmlspecialchars($p["description"] ?? "", ENT_QUOTES, "UTF-8"),
      "category" => htmlspecialchars($p["category"], ENT_QUOTES, "UTF-8"),
      "price" => (int)$p["price"],
      "unit" => htmlspecialchars($p["unit"], ENT_QUOTES, "UTF-8"),
      "badge" => $p["badge"],
      // image stored as filename only
      "image" => $p["image"] ? "uploads/products/" . $p["image"] : null
    ];
  }

  echo json_encode($data);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(["error" => "Server error"]);
}
