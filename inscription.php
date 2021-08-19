<?php
require_once 'fonction.php';
if (!empty($_GET['status'])) {
    $status = $_GET['status'];
} else {
    $status = 'index.php/';
}
switch ($status) {
    case 'true':
        verif_inscription();
        break;
    case 'validate':
        echo "<p>Vous êtes désormais enregistrer</p>";
        break;
    case 'noValidate':
        echo "<p>Une erreur c'est produite</p>";
        break;
    case 'incorrect':
        echo "<p>Mail ou mot de passe incorrect</p>";
        break;
    case 'used':
        echo "<p>Nom d'utilisateur indisponible</p>";
        break;
    default:
        # code...
        break;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Inscription Brief Simplon</h1>
    <div>
        <article>
            <h4>Veuillez remplir les champs ci-dessous</h4>
            <hr style="color: #000;
  width: 250px;
  height: 1px;
  margin: 15px;">
            <form action='inscription.php?status=true' method="post">
                <input type="email" name="mail" id="mail" placeholder="adresse@mail.com" required />
                <input type="email" name="retype_mail" id="retype_mail" placeholder="confirmer@mail.com" required />
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Le mot de passe doit être de minimum 8 caractères, il doit contenir une minuscule, une majuscule, un chiffre et ne doit contenir aucun caractère spéciaux" />
                <input type="password" name="retype_mdp" id="retype_mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Mot de passe" title="Le mot de passe doit être de minimum 8 caractères, il doit  contenir une minuscule, une majuscule, un chiffre et ne doit contenir aucun caractère spéciaux" required />
                <input type="submit" name="inscription" value="S'inscrire" />
            </form>
        </article>
        <hr style="color: #000;
  width: 250px;
  height: 1px;
  margin: 15px;">
        <a href="index.php"><b>Retour </a> écran de connexion</b>
    </div>
</body>

</html>
<?php
