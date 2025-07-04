<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />

</head>
<body>
    <h2 style="text-align: center;">hello from add user</h2>
    <form class="form-container"  action="" method="post">
        <input class="input-field"  type="text" placeholder="username" name="username" required><br>
        <input class="input-field"  type="text" placeholder="email" name="email" required><br>
        <input class="input-field"  type="text" placeholder="password" name="password" required><br>
        <select lass="input-field" name="role_id" >
        <?php foreach ($roles as $r) : ?>
            <option value="<?php $r["id"] ?>"><?= htmlspecialchars($r['name']) ?></option>
         <?php endforeach ; ?>
        </select>
        <button class="action-button" type="submit">add user</button>
    </form>
</body>
</html>