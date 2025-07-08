<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <style>
        .body{
            padding: 60px ;
        }
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
<table >
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>description</th>
        <th>action</th>
       
    </tr>
    <?php foreach ($category as $c): ?>
        <tr>
            <td><?=$c['id'] ?></td>
            <td><?=$c['name'] ?></td>
            <td><?=$c['description'] ?></td>
            <td>
                <a href="">delete</a>
                
            </td>
        </tr>
    <?php endforeach; ?>
</body>
</html>