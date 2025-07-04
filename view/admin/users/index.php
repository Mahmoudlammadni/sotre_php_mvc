<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        img {
            width: 60px;
        }

        .actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h2>All Users</h2>
    <a href="index.php?controller=product&action=index">see products</a>
    <a href="index.php?controller=user&action=create">add user</a>
<table >
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?=$user['id'] ?></td>
            <td><?=$user['username'] ?></td>
            <td><?=$user['email'] ?></td>
            <td><?=$user['role_name'] ?></td>
            <td><?=$user['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>