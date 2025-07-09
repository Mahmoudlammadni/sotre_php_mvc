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

<form  class="form-container" action="index.php?controller=client&action=update&id=<?= $client['user_id'] ?>" method="post" >
    <input type="text" name="username" class="input-field" value="<?= htmlspecialchars($client['username']) ?>" required>

    <textarea name="email" class="input-field" rows="4" required><?= htmlspecialchars($client['email']) ?></textarea>

    <input type="text" name="password" class="input-field" value="<?= htmlspecialchars($client['password']) ?>" required>
    
    <input type="text" name="phone" class="input-field" value="<?= htmlspecialchars($client['phone']) ?>" required>
    
    <input type="text" name="address" class="input-field" value="<?= htmlspecialchars($client['address']) ?>" required>

    <button type="submit" class="action-button">Update Client</button>
</form>

</body>
</html>