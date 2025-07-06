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
    <!-- <a href="index.php?controller=user&action=create">add user</a> -->
<table >
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>password</th>
        <th>phone</th>
        <th>address</th>
        <th>action</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($clients as $c): ?>
        <tr>
            <td><?=$c['client_id'] ?></td>
            <td><?=$c['username'] ?></td>
            <td><?=$c['email'] ?></td>
            <td><?=$c['password'] ?></td>
            <td><?=$c['phone'] ?></td>
            <td><?=$c['address'] ?></td>
            <td>
                <a href="/sotre_php_mvc/index.php?controller=client&action=destroy&id=<?= $c['user_id']?>
                "onclick="return confirm('Are you sure?');"><button>delete</button></a>
                
                <a ><button>update</button></a>
            </td>

            <td><?=$c['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>