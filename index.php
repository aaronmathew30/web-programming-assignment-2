<?php
// index.php
require_once 'db.php';

// fetch all contacts
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
$contacts = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Contacts Manager</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Contacts Manager</h1>
      <p class="small">Simple PHP + MySQL CRUD application</p>
    </header>

    <a href="create.php" class="button">+ Add New Contact</a>

    <?php if (count($contacts) === 0): ?>
      <div class="notice">No contacts found. Create one using the button above.</div>
    <?php else: ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Notes</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $c): ?>
          <tr>
            <td><?= htmlspecialchars($c['id']) ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['phone'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['dob'] ?? '') ?></td>
            <td><?= nl2br(htmlspecialchars($c['notes'] ?? '')) ?></td>
            <td>
              <a class="small" href="edit.php?id=<?= urlencode($c['id']) ?>">Edit</a> |
              <a class="small" href="delete.php?id=<?= urlencode($c['id']) ?>" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>
