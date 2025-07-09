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

<form   class="form-container" action="index.php?controller=user&action=update&id=<?= $user['id'] ?>" method="post" >
    <input type="text" class="input-field" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

    <textarea name="email"  class="input-field" rows="4" required><?= htmlspecialchars($user['email']) ?></textarea>

    <input type="text" class="input-field" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>

   <select class="input-field" name="role_id" required>
    <option value="" disabled>-- Select role --</option>
    <?php foreach ($roles as $r): ?>
        <?php if ($r['name'] !== 'client') : ?>
            <option value="<?= $r['id'] ?>" <?= $r['id'] == $user['role_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($r['name']) ?>
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

   

    <button   class="action-button"  type="submit">Update User</button>
</form>
</body>
</html>