<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />

</head>
<body>
        <h2 style="text-align: center;"> Register Form</h2>
        <form class="form-container" action="index.php?controller=client&action=StoreClient" method="post">
        <input class="input-field" type="text" placeholder="name" name="name" required> <br>
        <input class="input-field" type="text" placeholder="email" name="email" required> <br>
        <input class="input-field" type="password" placeholder="password" name="password" required> <br>
        <input class="input-field" type="text" placeholder="phone" name="phone"> <br>
        <input class="input-field" type="text" placeholder="address" name="address"> <br>
        <button class="action-button" >register</button>
        
    </form>
</body>
</html>