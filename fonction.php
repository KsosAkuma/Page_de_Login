<?php
////////
function is_connected(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}
function user_isnt_connected(): void
{
    if (!is_connected()) {
        header('Location:index.php');
        exit();
    }
}
////////
function verif_login(): void
{
    if (isset($_POST['submit'])) {
        if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {

            $login = [                                                                   // on récupère le contenu du formulaire
                'mail' => strtolower(trim($_POST['mail'])),
                'mdp' => trim($_POST['mdp']),
            ];

            // $host = 'localhost';
            // $dbname = 'id17446129_loginpage';
            // $password = '%Fc7dZMT}vVm366H';
            // $username = 'id17446129_dim';
            $host = 'localhost';
            $dbname = 'user_login';
            $password = '';
            $username = 'root';
            try {                                                                       // on récupère le contenu de la bdd
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                $pdostat = $pdo->query("SELECT * FROM user");
                $pdostat->setFetchMode(PDO::FETCH_ASSOC);
                $check_for_exit = false;

                foreach ($pdostat as $ligne) {                                          //Compare chaque 'ligne'BDD avec le contenu Formulaire
                    if ($ligne['mail'] == $login['mail'] && password_verify($login['mdp'], $ligne['mdp'])) {
                        session_start();
                        $_SESSION['connecte'] = 1;
                        $_SESSION['user'] = $login['mail'];
                        header('location:main.php');
                        $check_for_exit = true;
                    }
                }
                if ($check_for_exit == false) {
                    header('location:index.php?status=error');
                }
            } catch (Exception $e) {
                echo "ERREUR : " . $e->getMessage();
                header('location:index.php?status=error');
                die();
            }
        } else {
            header('Location:index.php?status=error');
        }
    }
}
//////
function get_error(): void
{
    // on récupère la valeur du paramètre page dans l'url
    if (!empty($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        $status = 'index.php/';
    }
    if ($status == "error") {
        echo "<strong><p>Désolé<p> <br> <p>Mail ou mot de passe incorrect</p> </strong> ";
    }
}
function check_mdp_format($mdp)
{
    $majuscule = preg_match('@[A-Z]@', $mdp);
    $minuscule = preg_match('@[a-z]@', $mdp);
    $chiffre = preg_match('@[0-9]@', $mdp);
    $specialCaractere = preg_match("#[^a-zA-Z0-9]#", $mdp);

    if (!$majuscule || !$specialCaractere || !$minuscule || !$chiffre || strlen($mdp) < 8) {
        return false;
    } else
        return true;
}
function verif_inscription(): void
{
    if (isset($_POST['inscription'])) {
        if (!empty($_POST['retype_mail']) && !empty($_POST['retype_mdp']) && !empty($_POST['mail']) && !empty($_POST['mdp'])) {
            if (check_mdp_format($_POST['mdp']) && check_mdp_format($_POST['retype_mdp'])) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['retype_mail'], FILTER_VALIDATE_EMAIL)) {
                    if ($_POST['retype_mail'] === $_POST['mail'] && $_POST['retype_mdp'] === $_POST['mdp']) {

                        //après avoir vérfié mail et mot de passe on peut enfin faire quelques choses
                        $host = 'localhost';
                        $dbname = 'user_login';
                        $password = '';
                        $username = 'root';
                        $data = [
                            'mail' => $_POST['mail'],
                            'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT)
                        ];
                        try {
                            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            $pdo->setAttribute(
                                PDO::ATTR_ERRMODE,
                                PDO::ERRMODE_EXCEPTION
                            );
                            $verifSQlMail = $pdo->query("SELECT * FROM user");
                            $verifSQlMail->setFetchMode(PDO::FETCH_ASSOC);
                            foreach ($verifSQlMail as $ligne) {                                          //Compare chaque 'ligne'BDD avec le contenu Formulaire
                                if ($ligne['mail'] == $_POST['mail']) {
                                    header('location:inscription.php?status=used');
                                    exit();
                                }
                            }
                            $sql = "INSERT INTO user (mail, mdp) VALUES (:mail, :mdp)";
                            $pdo->prepare($sql)->execute($data);
                            header('location:inscription.php?status=validate');
                        } catch (Exception $e) {
                            echo "ERREUR : " . $e->getMessage();
                            header('location:inscription.php?status=noValidate');
                            die();
                        }
                    } else {
                        header('location:inscription.php?status=incorrect');
                    }
                } else {
                    header('location:inscription.php?status=incorrect');
                }
            } else {
                header('location:inscription.php?status=incorrect');
            }
        } else {
            header('location:inscription.php?status=incorrect');
        }
    }
}
