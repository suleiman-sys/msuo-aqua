<?php
header("Content-Type: application/json");
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo json_encode(["error" => "Method not allowed"]);
  exit;
}

$name        = trim($_POST["name"] ?? "");
$description = trim($_POST["description"] ?? "");
$category    = $_POST["category"] ?? "";
$price       = (int)($_POST["price"] ?? 0);
$unit        = trim($_POST["unit"] ?? "");
$badge       = $_POST["badge"] ?? null;

$allowed = ["samaki","aquarium","kuku"];
if ($name==="" || $unit==="" || $price<=0 || !in_array($category,$allowed)) {
  echo json_encode(["error"=>"Invalid data"]);
  exit;
}

// IMAGE
$imageName = null;
if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
  $tmp  = $_FILES["image"]["tmp_name"];
  $size = $_FILES["image"]["size"];
  $ext  = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, ["jpg","jpeg","png","webp"])) {
    echo json_encode(["error"=>"Invalid image type"]); exit;
  }
  if ($size > 2*1024*1024) {
    echo json_encode(["error"=>"Image too large"]); exit;
  }
  if ($ext === "jpeg") $ext = "jpg";

  $imageName = "prod_" . time() . "_" . rand(1000,9999) . "." . $ext;
  $dir = __DIR__ . "/../../uploads/products/";
  if (!is_dir($dir)) mkdir($dir, 0755, true);
  move_uploaded_file($tmp, $dir . $imageName);
}

$stmt = $pdo->prepare("
  INSERT INTO products (name, description, category, price, unit, badge, image)
  VALUES (?,?,?,?,?,?,?)
");
$stmt->execute([$name,$description,$category,$price,$unit,$badge,$imageName]);

echo json_encode(["success"=>true]);
