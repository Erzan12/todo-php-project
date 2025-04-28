<?php
require_once 'Database.php';
require_once 'User.php';

// connect to db
$database = new Database();
$db = $database->connect();

// pass connection to user
$user = new User($db);

// handle error message
$error = null; 

// creating user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])){
    $result = $user->create($_POST['name'], $_POST['email']);
    if ($result === true) {
        header("Location: index.php");
        exit;
    }
    else {
        $error = $result; // capture error message
    }
}

// deleting user
if (isset($_GET['delete'])) {
    $user->delete($_GET['delete']);
    header("Location: index.php");
    exit;
}

// Get all Users
$user = $user->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>

    <h2>Create User</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="create">Create User</button>

        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
    <h2>All Users</h2>
    <table border="5" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
        </tr>
        <?php foreach ($user as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $u['id'] ?>">Edit</a> |
                    <a href="index.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

