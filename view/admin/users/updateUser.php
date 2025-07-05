<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css">
</head>
<body>
 
    
<h2 style="text-align: center;">Edit User</h2>

<form action="index.php?controller=user&action=update&id=<?= $user['id'] ?>" method="post" >
    <label for="username"> Name:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

    <label for="email">email:</label>
    <textarea name="email" rows="4" required><?= htmlspecialchars($user['email']) ?></textarea>

    <label for="user">password</label>
    <input type="text" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>

   <select name="role_id" required>
    <option value="" disabled>-- Select role --</option>
    <?php foreach ($roles as $r): ?>
        <?php if ($r['name'] !== 'client') : ?>
            <option value="<?= $r['id'] ?>" <?= $r['id'] == $user['role_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($r['name']) ?>
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

   

    <button type="submit">Update User</button>
</form>
</body>
</html>