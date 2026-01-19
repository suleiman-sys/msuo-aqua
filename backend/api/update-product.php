<?php
session_start();
require_once "../config/db.php";

/* POST only */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit;
}

/* CSRF */
if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
  die("Invalid CSRF token");
}

$id          = $_POST["id"] ?? null;
$name        = trim($_POST["name"] ?? "");
$description = trim($_POST["description"] ?? "");
$category    = $_POST["category"] ?? "";
$price       = (int)($_POST["price"] ?? 0);
$unit        = trim($_POST["unit"] ?? "");
$badge       = $_POST["badge"] ?: null;

if (!$id || $name==="" || $description==="" || $price<=0 || $unit==="") {
  die("Invalid data");
}

/* current image */
$stmt = $pdo->prepare("SELECT image FROM products WHERE id=?");
$stmt->execute([$id]);
$current = $stmt->fetch(PDO::FETCH_ASSOC);

$imageName = $current["image"];

/* new image optional */
if (!empty($_FILES["image"]["name"])) {
  $tmp = $_FILES["image"]["tmp_name"];

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $tmp);
  finfo_close($finfo);

  $allowed = [
    "image/jpeg" => "jpg",
    "image/png"  => "png",
    "image/webp" => "webp"
  ];

  if (!isset($allowed[$mime])) {
    die("Invalid image");
  }

  $imageName = "prod_" . time() . "_" . rand(1000,9999) . "." . $allowed[$mime];
  $dir = $_SERVER["DOCUMENT_ROOT"] . "/msuo-aqua/uploads/products/";
  if (!is_dir($dir)) mkdir($dir,0755,true);
  move_uploaded_file($tmp, $dir.$imageName);
}

/* UPDATE */
$update = $pdo->prepare("
  UPDATE products SET
    name=?, description=?, category=?, price=?, unit=?, badge=?, image=?
  WHERE id=?
");

$update->execute([
  $name,$description,$category,$price,$unit,$badge,$imageName,$id
]);

header("Location: /msuo-aqua/admin/products.php");
exit;
