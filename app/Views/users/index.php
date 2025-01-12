<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .flash-message {
            margin: 10px 0;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
        }
        .success {
            background-color: #4CAF50;
        }
        .error {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Users List</h1>
    <a href="<?= base_url('index.php/users/create') ?>">Create New User</a>

    <!-- Flash Messages -->
    <?php if (!empty($success)): ?>
        <div class="flash-message success"><?= $success ?>ss</div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="flash-message error"><?= $error ?>ee</div>
    <?php endif; ?>

    <?php if (!empty($users) && is_array($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Description</th>
                    <th>Profile</th>
                    <th>Gender</th>
                    <th>Skills</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td><?= $user['desc'] ?: 'N/A' ?></td>
                        <td>
                            <?php if ($user['profile']): ?>
                                <img src="<?= base_url('writable/' . $user['profile']) ?>" alt="Profile Picture" height="50">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><?= ucfirst($user['gender']) ?></td>
                        <td><?= $user['skills'] ?></td>
                        <td><?= $user['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <a href="<?= base_url('/users/edit/' . $user['id']) ?>">Edit</a> | 
                            <a href="<?= base_url('/users/delete/' . $user['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
