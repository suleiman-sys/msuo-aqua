<?php
// Linda ukurasa: admin lazima awe logged in
require "auth.php";
require_once "../backend/config/db.php";

// Pata bidhaa zote
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Admin – Bidhaa Zote</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      padding: 30px;
    }

    h2 {
      margin-bottom: 20px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .top-bar a {
      text-decoration: none;
      color: #0b5ed7;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #eee;
      text-align: left;
      font-size: 14px;
    }

    th {
      background: #f0f2f5;
    }

    tr:hover {
      background: #fafafa;
    }

    img {
      width: 60px;
      height: auto;
      border-radius: 6px;
    }

    .actions {
      display: flex;
      gap: 10px;
    }

    .actions a,
    .actions button {
      font-size: 13px;
      padding: 6px 10px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      text-decoration: none;
    }

    .edit {
      background: #0b5ed7;
      color: #fff;
    }

    .delete {
      background: #dc2626;
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <h2>📦 Bidhaa Zote</h2>
    <div>
      <a href="add-product.php">➕ Ongeza Bidhaa</a> |
      <a href="logout.php" style="color:#dc2626">🚪 Logout</a>
    </div>
  </div>

  <table>
    <tr>
      <th>Picha</th>
      <th>Jina</th>
      <th>Category</th>
      <th>Bei</th>
      <th>Unit</th>
      <th>Action</th>
    </tr>

    <?php if (count($products) === 0): ?>
      <tr>
        <td colspan="6" style="text-align:center">Hakuna bidhaa</td>
      </tr>
    <?php endif; ?>

    <?php foreach ($products as $p): ?>
      <tr>
        <td>
          <?php if (!empty($p["image"])): ?>
           <img src="/msuo-aqua/uploads/products/<?= htmlspecialchars($p["image"]) ?>" alt="">

          <?php else: ?>
            —
          <?php endif; ?>
        </td>

        <td><?= htmlspecialchars($p["name"]) ?></td>
        <td><?= htmlspecialchars($p["category"]) ?></td>
        <td><?= number_format($p["price"]) ?></td>
        <td><?= htmlspecialchars($p["unit"]) ?></td>

        <td>
          <div class="actions">
            <a
              href="edit-product.php?id=<?= $p["id"] ?>"
              class="edit"
            >✏️ Edit</a>

            <form
              action="../backend/api/delete-product.php"
              method="POST"
              onsubmit="return confirm('Una uhakika unataka kufuta bidhaa hii?');"
            >
              <input type="hidden" name="id" value="<?= $p["id"] ?>">
              <button type="submit" class="delete">🗑️ Delete</button>
            </form>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>

</body>
</html>
