<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 12/08/13
 * Time: 18:09
 * To change this template use File | Settings | File Templates.
 */
include 'includes/header.php';

echo '<div class="container signin">';

$login = $_POST['login'];

//mail & password check
$pwdMd5 = md5($login['password']);
$userUID = md5($login['mail']);
$queryCheck = $bdd->query("SELECT * FROM dl_users WHERE userUID = '" . $userUID . "'") or die (print_r($bdd->errorInfo()));
$result = $queryCheck->rowCount(PDO::FETCH_OBJ);
if ($result == 1) {
    $pwdCheck = $bdd->query("SELECT * FROM dl_users WHERE userUID = '" . $userUID . "' AND userPwd = '" . $pwdMd5 . "'") or die (print_r($bdd->errorInfo()));
    $pwdResult = $pwdCheck->rowCount(PDO::FETCH_OBJ);
    if ($pwdResult == 1) {
        $logMd5 = md5('logged');
        setcookie('sessionStat', $logMd5, $tmpSession);
        setcookie('sessionName', $userUID, $tmpSession);
        $url = 'home.php';
        header('Location: ' . $url);
    } else {
        ?>
        <div class="alert alert-danger text-center">
            <strong>Attention !</strong><br>

            <p>Vous avez oublié votre mot de passe ? Rendez-vous <a href="/user/forgot.php">içi</a>.</p>
            <a class="btn btn-primary" href="/">Retour</a>
        </div>
    <?php
    }
} elseif ($result == 0) {
    ?>
    <div class="alert text-center">
        <strong>Attention !</strong><br>

        <p>Le compte n'existe pas encore, pour accèder à notre service vous devez vous créer un compte.</p>
        <a class="btn btn-primary" href="/">Retour</a> <a class="btn btn-success" href="/register">Créer votre
            compte</a>
    </div>
<?php
} else {
    ?>
    <div class="alert text-center">
        <strong>Attention !</strong><br>

        <p>L'application rencontre un bug important, merci de contacter le service clientèle.</p>
        <a class="btn btn-default" href="/">Retour</a>
    </div>
<?php
}
include 'includes/footer.php';
