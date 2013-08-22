<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 12/08/13
 * Time: 12:34
 * To change this template use File | Settings | File Templates.
 */
include 'includes/header.php';
require_once 'includes/functions.php';

echo '<div class="container signin">';

$step = (isset($_GET['step'])) ? $_GET['step'] : "";
switch ($step) {
    case 'validation':
        $mail = $_POST['data']['mailAddress'];
        $pwd = $_POST['data']['pwd'];
        $pwdconf = $_POST['data']['pwdConf'];

        //email verification
        if (mailValidator($mail)) {
            $mailValidator = 'ok';
        } else {
            $mailValidator = 'nok';
        }

        if ($pwd == $pwdconf) {
            if (pwdValidator($pwd)) {
                $pwdValidator = 'ok';
            } else {
                $pwdValidator = 'nok1';
            }
        } else {
            $pwdValidator = 'nok2';
        }

        if ($pwdValidator == 'ok' && $mailValidator == 'ok') {
            $queryPwd = $bdd->query("SELECT * FROM dl_users WHERE userMail = '" . $mail . "'") or die (print_r($bdd->errorInfo()));
            $result = $queryPwd->rowCount(PDO::FETCH_OBJ);
            if ($result == '1') {
                //account allready exists
                ?>
                <div class="alert text-center">
                    <strong>Attention !</strong><br>

                    <p>L'adresse mail que vous avez saisi est déjà dans notre base.<br>
                        Avez-vous <a href="/user/forgot.php">oublié votre mot de passe ?</a></p>
                    <a class="btn btn-primary" href="/">Retour</a>
                </div>
            <?php
            } elseif ($result == '0') {
                //account creation
                $pwdMd5 = md5($pwd);
                $userUID = md5($mail);
                $req = $bdd->exec("INSERT INTO dl_users (userMail, userPwd, userUID) VALUES ('" . $mail . "','" . $pwdMd5 . "','" . $userUID . "')") or die (print_r($bdd->errorInfo()));
                ?>
                <div class="alert alert-success text-center">
                    <strong>Félicitation !</strong><br>
                    Votre compte a été créer avec succès.<br>
                    <a class="btn btn-success" href="/">Retour</a>
                </div>
                <?php
                //send mail
                $subject = 'Création de votre compte sur dl.ablcoud.fr';
                // message
                $message = '
                <html>
                    <head>
                        <title>Création de votre compte sur dl.ablcoud.fr</title>
                    </head>
                    <body>
                        <p>Bonjour,</p>
                        <p>Votre compte sur le site de partage de fichiers <a href="' . $_SERVER['HTTP_HOST'] . '">dl.abcloud.fr</a> est créé.</p>
                        <p>Trouver ci-joint vos informations de connexion.</p>
                        <table>
                            <tr>
                                <td>Identifiant :</td>
                                <td>' . $mail . '</td>
                            </tr>
                            <tr>
                                <td>Mot de passe :</td>
                                <td>' . $pwd . '</td>
                            </tr>
                        </table>
                        <p>Pour vous connecter merci de vous rendre sur la page d\'accueil du site, disponible en <a href="' . $_SERVER['HTTP_HOST'] . '">cliquant içi</a>.</p>
                        <p>Cordialement,<br>
                        L\'équipe de dl.abcloud.fr</p>
                    </body>
                </html>
                ';
                // html send mail header
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // additionnals headers
                $headers .= 'From: Inscription - dl.abcloud.fr <noreply@abcloud.fr>' . "\r\n";
                // send
                mail($mail, $subject, $message, $headers);
                //creat the private directory
                $cmd = 'mkdir ./directory/' . $data->userUID;
                $creatDirectory = exec($cmd);
            } else {
                ?>
                <div class="alert text-center">
                    <strong>Attention !</strong><br>

                    <p>L'application rencontre un bug important, merci de contacter le service clientèle.</p>
                    <a class="btn btn-default" href="/">Retour</a>
                </div>
            <?php
            }
            echo '</div>';
        } else {
            ?>
            <form class="form-signin" method="POST" action="?step=validation">
                <div class="alert alert-danger">
                    <strong>Oups !</strong> L'adresse email ou le mot de passe que vous avez saisi sont invalides.
                </div>
                <input type="text" class="form-control <?php if ($mailValidator == 'nok') {
                    echo 'alert-danger';
                } ?>" id="mailAddress" name="data[mailAddress]"
                       value="<?php echo $mail; ?>" <?php if ($mailValidator == 'nok') {
                    echo 'autofocus';
                } ?>>
                <input type="password" class="form-control <?php if ($pwdValidator == 'nok1') {
                    echo 'alert-danger';
                } ?>" id="pwd" name="data[pwd]"
                       value="<?php echo $pwd; ?>" <?php if ($pwdValidator == 'nok1' || $pwdValidator == 'nok2') {
                    echo 'autofocus';
                } ?>>
                <input type="password" class="form-control <?php if ($pwdValidator == 'nok2') {
                    echo 'alert-danger';
                } ?>" id="pwdConf" name="data[pwdConf]" placeholder="Confirmation de votre mot de passe.">
                <button class="btn btn-large btn-primary btn-block" type="submit">S'enregistrer</button>
            </form>
        <?php
        }
        break;
    default:
        ?>
            <form class="form-signin" method="POST" action="?step=validation">
                <h2 class="form-signin-heading">Créer votre compte maintenant.</h2>
                <input type="text" class="form-control" id="mailAddress" name="data[mailAddress]"
                       placeholder="Votre adresse mail." autofocus>
                <input type="password" class="form-control" id="pwd" name="data[pwd]" placeholder="Votre mot de passe.">
                <input type="password" class="form-control" id="pwdConf" name="data[pwdConf]"
                       placeholder="Confirmation de votre mot de passe.">
                <button class="btn btn-large btn-primary btn-block" type="submit">S'enregistrer</button>
            </form>
        <?php
        break;
}

echo '</div> <!-- /container -->';

?>
</body>
</html>