<?php
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

// initialize error message
$error = null;

// Get existing user data
$id = $_GET['id'] ?? null;
$current = null;
if ($id) {
    $users = $user->read();
    foreach ($users as $u) {
        if ($u['id'] == $id) {
            $current = $u;
            break;
        }
    }
}

// handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $user->update($id, $_POST['name'], $_POST['email']);
    if ($result === true) {
        header("Location: index.php");
        exit;
    } else {
        $error = $result; // capture error message
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($current): ?>
        <form method="POST">
            <input type="text" name="name" value="<?= htmlspecialchars($current['name']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($current['email']) ?>" required>
            <button type="submit">Update User</button>
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

</body>
</html>