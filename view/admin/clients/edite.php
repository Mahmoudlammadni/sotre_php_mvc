<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css">

</head>
<body>
   

   
<h2 style="text-align: center;">Edit Client</h2>

<form action="index.php?controller=client&action=update&id=<?= $client['user_id'] ?>" method="post" >
    <label for="username"> Name:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($client['username']) ?>" required>

    <label for="email">email:</label>
    <textarea name="email" rows="4" required><?= htmlspecialchars($client['email']) ?></textarea>

    <label for="user">password</label>
    <input type="text" name="password" value="<?= htmlspecialchars($client['password']) ?>" required>
    
      <label for="phone">phone</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
    
      <label for="address">address</label>
    <input type="text" name="address" value="<?= htmlspecialchars($client['address']) ?>" required>

    <button type="submit">Update Client</button>
</form>

</body>
</html>