<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
         <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />

</head>
<body>
     <h2 style="text-align: center;"> add Category</h2>
    <form class="form-container"  action="/sotre_php_mvc/index.php?controller=category&action=store" method="post">
        <input class="input-field"  type="text" placeholder="name" name="name" required><br>
        <input class="input-field"  type="text" placeholder="description" name="description" required><br>
        <button class="action-button" type="submit">add client</button>
    </form>   

</body>
</html>