<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 12/08/13
 * Time: 17:12
 * To change this template use File | Settings | File Templates.
 */

include '../includes/header.php';
require_once '../includes/functions.php';

$case = (isset($_GET['case'])) ? $_GET['case'] : "";
switch($case){
    case 'pwdReset':
        $queryVerifMail = $bdd->query("SELECT userUID FROM dl_users WHERE userMail = '".$_POST['mailRecovery']."'") or die (print_r($bdd->errorInfo()));
        $verifMail = $queryVerifMail->rowCount(PDO::FETCH_OBJ);
        if($verifMail == 0){
            //adresse mail non présente en bdd
            ?>
            <div class="alert alert-info text-center">
                <strong>Attention !</strong>
                <p>Vous ne disposez pas de compte sur notre site. Désirez-vous créer un compte ?</p>
                <a class="btn btn-primary" href="/register.php">Création de compte</a>
            </div>
        <?php
        } elseif($verifMail == 1) {
            //on génère un ID unique timestamp+userUID
            $uid = md5(time()).$_COOKIE['sessionName'];
            //qu'on enregistre en bdd
            $insertUID = $bdd->exec("UPDATE dl_users SET userPwdResetUID = '".$uid."' WHERE userMail = '".$_POST['mailRecovery']."'") or die (print_r($bdd->errorInfo()));
            //réinitialisation possible

            ?>
            <div class="alert alert-success text-center">
                <strong>Réinitialisation de mot de passe</strong>
                <p>La réinitialisation de votre mot de passe sera possible dés que vous aurez reçu le mail de confirmation.<br>Ce mail contiendra les instructions à suivre pour finaliser la réinitialisation de votre mot de passe.</p>
                <a class="btn btn-primary" href="/">Accueil</a>
            </div>
            <?php
            //send mail
            $subject = 'Réinitialisation du mot de passe de votre compte sur dl.ablcoud.fr';
            // message
            $message = '
            <html>
                <head>
                    <title>Réinitialisation du mot de passe de votre compte sur dl.ablcoud.fr</title>
                </head>
                <body>
                    <p>Bonjour,</p>
                    <p>Nous avons réinitialisé votre compte. Suivez les instructions ci-dessous si vous avez émis cette demande.<br>
                    Ignorez cet e-mail si la demande de réinitialisation de votre mot de passe n\'a pas été déposée par vous. Ne vous inquiétez pas, votre compte est toujours sécurisé.<br>
                    Cliquez sur le lien suivant pour définir un nouveau mot de passe.</p>
                    <a href="'.$_SERVER['HTTP_HOST'].'/user/forgot.php?case=resetPwd&UID='.$uid.'">'.$_SERVER['HTTP_HOST'].'/user/forgot.php?case=resetPwd&UID='.$uid.'</a>
                    <p>Si l\'activation ne fonctionne pas après avoir cliqué sur le lien, vous pouvez copier le lien dans votre fenêtre de navigateur ou le saisir directement.</p>
                    <p>Cordialement,<br>
                    L\'équipe de dl.abcloud.fr</p>
                </body>
            </html>
            ';
            // html send mail header
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // additionnals headers
            $headers .= 'From: Réinitialisation - dl.abcloud.fr <noreply@abcloud.fr>' . "\r\n";
            // send
            mail($_POST['mailRecovery'], $subject, $message, $headers);
        } else {
            echo 'perdu !';
        }
        break;
    case 'resetPwd':
        $action = (isset($_GET['action'])) ? $_GET['action'] : "";
        switch($action){
            case'reset':
                if(isset($_GET['UID'])){
                    $newPwd = $_POST['dataNewPwd'];
                    if($newPwd['pwd']==$newPwd['pwdConf']){
                        if(pwdValidator($newPwd['pwd'])){
                            //mot de passe coérent et validé
                            //enregistrement nouveau mot de passe
                            $updatePwd = $bdd->exec("UPDATE dl_users SET userPwd = '".md5($newPwd['pwd'])."' WHERE userPwdResetUID = '".$_GET['UID']."'") or die (print_r($bdd->errorInfo()));
                            //remise à zéro de userPwdResetUID
                            $queryInfosUser = $bdd->query("SELECT userMail FROM dl_users WHERE userPwdResetUID ='".$_GET['UID']."'") or die (print_r($bdd->errorInfo()));
                            $infosUser = $queryInfosUser->fetch(PDO::FETCH_OBJ);
                            $eraseResetUID = $bdd->exec("UPDATE dl_users SET userPwdResetUID = NULL WHERE userMail = '".$infosUser->userMail."'") or die (print_r($bdd->errorInfo()));
                            ?>
                            <div class="alert alert-success text-center">
                                <strong>Bravo !</strong> <p>Votre mot de passe à été changer avec succès.</p>
                                <a class="btn btn-success" href="/">Retour à l'accueil</a>
                            </div>
                            <?php
                        } else {
                            // mot de passe similaire invalidé
                            setcookie('newPwdChange','invalid');
                            ?>
                            <meta http-equiv="Refresh" content="0;URL=<?php echo $_SERVER['HTTP_REFERER']; ?>">
                        <?php
                        }
                    } else {
                        //mot de passe différent
                        setcookie('newPwdChange','inconsistent');
                        ?>
                        <meta http-equiv="Refresh" content="0;URL=<?php echo $_SERVER['HTTP_REFERER']; ?>">
                    <?php
                    }
                } else {
                    ?>
                    <meta http-equiv="Refresh" content="0;URL=<?php echo $_SERVER['HTTP_REFERER']; ?>">
                <?php
                }
                break;
            default:
                if(isset($_GET['UID'])){
                    $queryVerifUID = $bdd->query("SELECT userUID FROM dl_users WHERE userPwdResetUID = '".$_GET['UID']."'") or die (print_r($bdd->errorInfo()));
                    $verifUID = $queryVerifUID->rowCount(PDO::FETCH_OBJ);
                    if($verifUID == 1){
                        ?>
                        <div class="well">
                            <h3 class="text-center">Mot de passe oublié</h3>
                        </div>
                        <?php
                        if(!empty($_COOKIE['newPwdChange'])){
                            ?>
                            <div class="alert alert-danger text-center">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Attention !</strong>
                                <?php
                                if($_COOKIE['newPwdChange'] == 'invalid'){
                                    setcookie('newPwdChange', '', time(), null, null, false, true);
                                    ?>
                                    <p>Le mot de passe que vous avez saisi ne satisfait pas aux critères de securité du service.</p>
                                <?php
                                } elseif($_COOKIE['newPwdChange'] == 'inconsistent'){
                                    setcookie('newPwdChange', '', time(), null, null, false, true);
                                    ?>
                                    <p>Le mot de passe et la confirmation de mot de passe doivent être identitique pour être validé.</p>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="well">
                            <div class="row">
                                <div class="col-offset-1 col-lg-7">
                                    <p>Merci de remplir ce formulaire pour réinitialiser votre mot de passe.</p>
                                    <form action="?case=resetPwd&action=reset&UID=<?php echo $_GET['UID']; ?>" method="POST">
                                        <div class="input-group profilForm">
                                            <span class="input-group-addon input-lg">Nouveau mot de passe</span>
                                            <input type="password" class="form-control input-lg" name="dataNewPwd[pwd]" placeholder="Nouveau mot de passe">
                                        </div>
                                        <div class="input-group profilForm">
                                            <span class="input-group-addon input-lg">Confirmation du nouveau mot de passe</span>
                                            <input type="password" class="form-control input-lg" name="dataNewPwd[pwdConf]" placeholder="Confirmation du mot de passe" ">
                                        </div>
                                        <div class="text-center" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-success">Modifier mon mot de passe</button>
                                            <button type="reset" class="btn btn-warning">Réinitialiser</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        ?>
                        <meta http-equiv="Refresh" content="0;URL=/">
                    <?php
                    }
                } else {
                    ?>
                    <meta http-equiv="Refresh" content="0;URL=/">
                <?php
                }
                break;
        }
        break;
    default:
        ?>
            <div class="well">
                <h3 class="text-center">Mot de passe oublié</h3>
            </div>
            <div class="well">
                <div class="row">
                    <div class="col-offset-1 col-lg-7">
                        <p>Un mail de réinitialisation de mot de passe va vous être envoyé dès que nous aurons validé que votre adresse figure bien dans notre base de donnée.</p>
                        <form action="?case=pwdReset" method="post">
                            <div class="input-group profilForm">
                                <span class="input-group-addon input-lg">Votre adresse mail</span>
                                <input type="text" class="form-control input-lg" name="mailRecovery" placeholder="Adresse mail de votre compte">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-default">Demande de réinitialisation</button>
                                <a class="btn btn-warning" href="/">Annuler la demande</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        break;
}
include '../includes/footer.php';