<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>All Users</h2>
<table border="1" cellpadding="8">
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