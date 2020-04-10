<?php
    session_start();
    echo session_id();
    if($_SESSION['id']!=session_id()) header('location: index.php');
    echo $_SESSION['id']==session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome bitchh<br>
    <?php echo $_SESSION['name']?>
</body>
</html>