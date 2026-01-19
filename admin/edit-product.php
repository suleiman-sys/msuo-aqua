<?php
require "auth.php";
require_once "../backend/config/db.php";

$id = $_GET["id"] ?? null;
if (!$id) {
  die("Bidhaa haijapatikana");
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  die("Bidhaa haipo");
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Edit Bidhaa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial; background:#f4f6f9; padding:30px }
    .box { max-width:520px; margin:auto; background:#fff; padding:25px; border-radius:10px }
    input, textarea, select, button {
      width:100%; padding:10px; margin-bottom:12px; border-radius:6px; border:1px solid #ccc;
    }
    button { background:#0b5ed7; color:#fff; border:none; cursor:pointer }
    img { max-width:100%; border-radius:8px; margin-bottom:10px }
  </style>
</head>
<body>

<div class="box">
  <h2>✏️ Edit Bidhaa</h2>

  <?php if ($product["image"]): ?>
    <img src="/msuo-aqua/uploads/products/<?= htmlspecialchars($product["image"]) ?>">
  <?php endif; ?>

  <form method="POST" action="../backend/api/update-product.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product["id"] ?>">

    <input type="text" name="name" value="<?= htmlspecialchars($product["name"]) ?>" required>

    <textarea name="description" rows="4" required><?= htmlspecialchars($product["description"]) ?></textarea>

    <select name="category" required>
      <option value="samaki" <?= $product["category"]==="samaki"?"selected":"" ?>>Samaki</option>
      <option value="aquarium" <?= $product["category"]==="aquarium"?"selected":"" ?>>Aquarium</option>
      <option value="kuku" <?= $product["category"]==="kuku"?"selected":"" ?>>Kuku</option>
    </select>

    <input type="number" name="price" value="<?= $product["price"] ?>" required>
    <input type="text" name="unit" value="<?= htmlspecialchars($product["unit"]) ?>" required>

    <select name="badge">
      <option value="">-- Hakuna badge --</option>
      <option value="mpya" <?= $product["badge"]==="mpya"?"selected":"" ?>>Mpya</option>
      <option value="maarufu" <?= $product["badge"]==="maarufu"?"selected":"" ?>>Maarufu</option>
      <option value="offer" <?= $product["badge"]==="offer"?"selected":"" ?>>Offer</option>
    </select>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <label>Badilisha picha (hiari)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">💾 Hifadhi Mabadiliko</button>
  </form>
</div>

</body>
</html>
<?php
require "auth.php";
require_once "../backend/config/db.php";

$id = $_GET["id"] ?? null;
if (!$id) {
  die("Bidhaa haijapatikana");
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  die("Bidhaa haipo");
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Edit Bidhaa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial; background:#f4f6f9; padding:30px }
    .box { max-width:520px; margin:auto; background:#fff; padding:25px; border-radius:10px }
    input, textarea, select, button {
      width:100%; padding:10px; margin-bottom:12px; border-radius:6px; border:1px solid #ccc;
    }
    button { background:#0b5ed7; color:#fff; border:none; cursor:pointer }
    img { max-width:100%; border-radius:8px; margin-bottom:10px }
  </style>
</head>
<body>

<div class="box">
  <h2>✏️ Edit Bidhaa</h2>

  <?php if ($product["image"]): ?>
    <img src="/msuo-aqua/uploads/products/<?= htmlspecialchars($product["image"]) ?>">
  <?php endif; ?>

  <form method="POST" action="../backend/api/update-product.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product["id"] ?>">

    <input type="text" name="name" value="<?= htmlspecialchars($product["name"]) ?>" required>

    <textarea name="description" rows="4" required><?= htmlspecialchars($product["description"]) ?></textarea>

    <select name="category" required>
      <option value="samaki" <?= $product["category"]==="samaki"?"selected":"" ?>>Samaki</option>
      <option value="aquarium" <?= $product["category"]==="aquarium"?"selected":"" ?>>Aquarium</option>
      <option value="kuku" <?= $product["category"]==="kuku"?"selected":"" ?>>Kuku</option>
    </select>

    <input type="number" name="price" value="<?= $product["price"] ?>" required>
    <input type="text" name="unit" value="<?= htmlspecialchars($product["unit"]) ?>" required>

    <select name="badge">
      <option value="">-- Hakuna badge --</option>
      <option value="mpya" <?= $product["badge"]==="mpya"?"selected":"" ?>>Mpya</option>
      <option value="maarufu" <?= $product["badge"]==="maarufu"?"selected":"" ?>>Maarufu</option>
      <option value="offer" <?= $product["badge"]==="offer"?"selected":"" ?>>Offer</option>
    </select>

    <label>Badilisha picha (hiari)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">💾 Hifadhi Mabadiliko</button>
  </form>
</div>

</body>
</html>
<?php
require "auth.php";
require_once "../backend/config/db.php";

$id = $_GET["id"] ?? null;
if (!$id) {
  die("Bidhaa haijapatikana");
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  die("Bidhaa haipo");
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Edit Bidhaa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial; background:#f4f6f9; padding:30px }
    .box { max-width:520px; margin:auto; background:#fff; padding:25px; border-radius:10px }
    input, textarea, select, button {
      width:100%; padding:10px; margin-bottom:12px; border-radius:6px; border:1px solid #ccc;
    }
    button { background:#0b5ed7; color:#fff; border:none; cursor:pointer }
    img { max-width:100%; border-radius:8px; margin-bottom:10px }
  </style>
</head>
<body>

<div class="box">
  <h2>✏️ Edit Bidhaa</h2>

  <?php if ($product["image"]): ?>
    <img src="/msuo-aqua/uploads/products/<?= htmlspecialchars($product["image"]) ?>">
  <?php endif; ?>

  <form method="POST" action="../backend/api/update-product.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product["id"] ?>">

    <input type="text" name="name" value="<?= htmlspecialchars($product["name"]) ?>" required>

    <textarea name="description" rows="4" required><?= htmlspecialchars($product["description"]) ?></textarea>

    <select name="category" required>
      <option value="samaki" <?= $product["category"]==="samaki"?"selected":"" ?>>Samaki</option>
      <option value="aquarium" <?= $product["category"]==="aquarium"?"selected":"" ?>>Aquarium</option>
      <option value="kuku" <?= $product["category"]==="kuku"?"selected":"" ?>>Kuku</option>
    </select>

    <input type="number" name="price" value="<?= $product["price"] ?>" required>
    <input type="text" name="unit" value="<?= htmlspecialchars($product["unit"]) ?>" required>

    <select name="badge">
      <option value="">-- Hakuna badge --</option>
      <option value="mpya" <?= $product["badge"]==="mpya"?"selected":"" ?>>Mpya</option>
      <option value="maarufu" <?= $product["badge"]==="maarufu"?"selected":"" ?>>Maarufu</option>
      <option value="offer" <?= $product["badge"]==="offer"?"selected":"" ?>>Offer</option>
    </select>

    <label>Badilisha picha (hiari)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">💾 Hifadhi Mabadiliko</button>
  </form>
</div>

</body>
</html>
