<?php
// create.php
require_once 'db.php';

$errors = [];
$values = ['name'=>'', 'email'=>'', 'phone'=>'', 'dob'=>'', 'notes'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // basic sanitization
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    // validation
    if ($name === '') $errors[] = "Name is required.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    // phone optional; basic length check
    if ($phone !== '' && strlen($phone) < 6) $errors[] = "Phone number seems too short.";

    if (empty($errors)) {
        // insert with prepared statement
        $sql = "INSERT INTO contacts (name, email, phone, dob, notes) VALUES (:name, :email, :phone, :dob, :notes)";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([
                ':name'=>$name,
                ':email'=>$email,
                ':phone'=>$phone !== '' ? $phone : null,
                ':dob'=>$dob !== '' ? $dob : null,
                ':notes'=>$notes !== '' ? $notes : null,
            ]);
            // redirect to index with success
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            // handle duplicate email or other DB error
            if ($e->getCode() === '23000') {
                $errors[] = "A contact with this email already exists.";
            } else {
                $errors[] = "Database error: " . htmlspecialchars($e->getMessage());
            }
        }
    }

    $values = ['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'dob'=>$dob, 'notes'=>$notes];
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create Contact</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Create Contact</h1>
    <a href="index.php" class="button">← Back to list</a>

    <?php if (!empty($errors)): ?>
      <div class="notice" style="background:#ffecec; border-left-color:#e03b3b;">
        <ul>
          <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" novalidate>
      <div class="form-row">
        <label for="name">Name *</label>
        <input id="name" name="name" type="text" value="<?= htmlspecialchars($values['name']) ?>" required>
      </div>

      <div class="form-row">
        <label for="email">Email *</label>
        <input id="email" name="email" type="email" value="<?= htmlspecialchars($values['email']) ?>" required>
      </div>

      <div class="form-row">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="text" value="<?= htmlspecialchars($values['phone']) ?>">
      </div>

      <div class="form-row">
        <label for="dob">Date of Birth</label>
        <input id="dob" name="dob" type="date" value="<?= htmlspecialchars($values['dob']) ?>">
      </div>

      <div class="form-row">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes"><?= htmlspecialchars($values['notes']) ?></textarea>
      </div>

      <div class="form-actions">
        <button class="btn" type="submit">Create</button>
      </div>
    </form>
  </div>
</body>
</html>
