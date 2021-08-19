<?php
require 'fonction.php';
if (is_connected()) {
  header('location:main.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Page_de_Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Page de Login</h1>
  <div>
    <h4>Veuillez remplir les champs ci-dessous</h4>
    <hr style="color: #000;
  width: 250px;
  height: 1px;
  margin: 15px;">
    <form action="login_verif.php" method="post">
      <input type="email" name="mail" id="mail" placeholder="adresse@mail.com" required />
      <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required />
      <input type="submit" name="submit" value="Connexion" />
    </form>
    <article>
      <?php
      get_error();
      ?>
    </article>
    <hr style="color: #000;
  width: 250px;
  height: 1px; margin: 15px;">

    <p>Pas encore inscrit? <a href="inscription.php">S'inscrire</a></p>

  </div>
</body>

</html>