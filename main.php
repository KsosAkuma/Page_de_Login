<?php
// require_once 'fonction.php';
require_once 'login_verif.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <span><a href="deconnection.php"></a></span>
        <?php
        if (is_connected()) {
            echo "<big> {$_SESSION['user']} vous êtes désormais connecté </big>";
        } else {
            user_isnt_connected();
        }

        ?>
    </div>
</body>

</html>