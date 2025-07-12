<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />
</head>
<body>
    <h2 style="text-align: center;"> Login Form</h2>
    <form  class="form-container" action="index.php?controller=user&action=login" method="POST">
    <input class="input-field"  type="email" name="email" required placeholder="Email">
    <input class="input-field" type="password" name="password" required placeholder="Password">
    <button class="action-button"  type="submit">Login</button>
</form>

</body>
</html>