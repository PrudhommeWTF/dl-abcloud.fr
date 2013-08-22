<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 13/08/13
 * Time: 09:00
 * To change this template use File | Settings | File Templates.
 */

include '../includes/sessionCheck.php';
include '../includes/header.php';

//database request for user's informations
$req = $bdd->query("SELECT * FROM dl_users WHERE userUID = '" . $_COOKIE['sessionName'] . "'") or die (print_r($bdd->errorInfo()));
$data = $req->fetch(PDO::FETCH_OBJ);

$case = (isset($_GET['case'])) ? $_GET['case'] : "";
switch ($case) {
    case 'ch_coord':
        $dataForm = $_POST['dataForm'];
        $dataForm['fname'] = urlencode($dataForm['fname']);
        $dataForm['sname'] = urlencode($dataForm['sname']);

        //mail verification
        if (filter_var($dataForm['mail'], FILTER_VALIDATE_EMAIL) !== false) {
            $mailValidator = 'ok';
            //mail du formulaire != mail dans la base pour cette utilisateur
            if (md5($dataForm['mail']) !== $data->userMail) {
                //utilisateur veux changer son adresse mail => vérifier si la nouvelle n'est pas déjà dans la base de données
                $reqVerifMail = $bdd->query("SELECT userUID FROM dl_users WHERE userMail = '" . $dataForm['mail'] . "' AND userMail <> '" . $dataForm['mail'] . "'") or die (print_r($bdd->errorInfo()));
                $verifMail = $reqVerifMail->rowCount(PDO::FETCH_OBJ);
                if ($verifMail != 0) {
                    //l'adresse mail de destination est déjà en base
                    setcookie('mailUserChange', 'alreadyExist');
                    ?>
                    <meta http-equiv="Refresh" content="0;URL=/user/profil.php">
                <?php
                } else {
                    //changement des informations dans la base
                    $insertData = $bdd->exec("UPDATE dl_users SET userFName='" . $dataForm['fname'] . "', userSName='" . $dataForm['sname'] . "', userMail='" . $dataForm['mail'] . "' WHERE userUID = '" . $_COOKIE['sessionName'] . "'") or die (print_r($bdd->errorInfo()));
                    ?>
                    <div class="alert alert-success text-center">
                        <strong>Bravo !</strong>

                        <p>Les changements d'informations on été opérer avec succès.</p>
                        <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour à la gestion de
                            profil</a>
                    </div>
                <?php
                }
            }
        } else {
            setcookie('mailUserChange', 'invalid');
            ?>
            <meta http-equiv="Refresh" content="0;URL=/user/profil.php">
        <?php
        }
        break;
    case 'ch_pwd':
        function pwdValidator($password)
        {
            if (strlen($password) >= 4)
                return true;
            else
                return false;
        }

        $dataPwd = $_POST['dataPwd'];

        //password verification
        if ($dataPwd['pwd'] == $dataPwd['pwdConf']) {
            if (pwdValidator($dataPwd['pwd'])) {
                //mot de passe similaire validé
                //enregsitrement nouveau mot de passe
                $changePwd = $bdd->exec("UPDATE dl_users SET userPwd = '" . md5($dataPwd['pwd']) . "' WHERE userUID = '" . $_COOKIE['sessionName'] . "'") or die (print_r($bdd->errorInfo()));
                ?>
                <div class="alert alert-success text-center">
                    <strong>Bravo !</strong>

                    <p>Votre mot de passe à été changer avec succès.</p>
                    <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour à la gestion de
                        profil</a>
                </div>
            <?php
            } else {
                // mot de passe similaire invalidé
                setcookie('pwdUserChange', 'invalid');
                ?>
                <meta http-equiv="Refresh" content="0;URL=/user/profil.php">
            <?php
            }
        } else {
            //mot de passe différent
            setcookie('pwdUserChange', 'inconsistent');
            ?>
            <meta http-equiv="Refresh" content="0;URL=/user/profil.php">
        <?php
        }
        break;
    default:
        ?>
            <div class="well">
                <h3 class="text-center">Votre profil</h3>
                <?php
                if (!empty($_COOKIE['mailUserChange']) || !empty($_COOKIE['pwdUserChange'])) {
                    ?>
                    <div class="alert alert-danger text-center">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Attention !</strong>
                        <?php
                        if ($_COOKIE['mailUserChange'] == 'alreadyExist') {
                            setcookie('mailUserChange', '', time(), null, null, false, true);
                            ?>
                            <p>L'adresse mail que vous désirez utiliser est déjà présente dans notre base de compte.</p>
                        <?php
                        } elseif ($_COOKIE['mailUserChange'] == 'invalid') {
                            setcookie('mailUserChange', '', time(), null, null, false, true);
                            ?>
                            <p>L'adresse mail que vous avez saisi est invalide, merci de retenter votre chance.</p>
                        <?php
                        } elseif ($_COOKIE['pwdUserChange'] == 'invalid') {
                            setcookie('pwdUserChange', '', time(), null, null, false, true);
                            ?>
                            <p>Le mot de passe que vous avez saisi ne satisfait pas aux critères de securité du
                                service.</p>
                        <?php
                        } elseif ($_COOKIE['pwdUserChange'] == 'inconsistent') {
                            setcookie('pwdUserChange', '', time(), null, null, false, true);
                            ?>
                            <p>Le mot de passe et la confirmation de mot de passe doivent être identitique pour être
                                validé.</p>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
                <ul class="nav nav-pills" id="myTab">
                    <li class="profilPills active"><a href="#home" data-toggle="pill"><span
                                class="glyphicon glyphicon-user"></span> Vos coordonnées</a></li>
                    <li class="profilPills"><a href="#offre" data-toggle="pill"><span
                                class="glyphicon glyphicon-shopping-cart"></span> Votre offre</a></li>
                    <li class="profilPills"><a href="#password" data-toggle="pill"><span
                                class="glyphicon glyphicon-lock"></span> Votre mot de passe</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-offset-1 col-lg-7">
                                <form action="?case=ch_coord" method="POST">
                                    <div class="input-group profilForm">
                                        <span class="input-group-addon input-lg">Prénom</span>
                                        <input type="text" class="form-control input-lg" name="dataForm[fname]"
                                               value="<?php echo urldecode($data->userFName); ?>">
                                    </div>
                                    <div class="input-group profilForm">
                                        <span class="input-group-addon input-lg">Nom</span>
                                        <input type="text" class="form-control input-lg" name="dataForm[sname]"
                                               value="<?php echo urldecode($data->userSName); ?>">
                                    </div>
                                    <div class="input-group profilForm">
                                        <span class="input-group-addon input-lg">Adresse mail</span>
                                        <input type="text" class="form-control input-lg" name="dataForm[mail]"
                                               value="<?php echo $data->userMail; ?>">
                                    </div>
                                    <div class="text-center" style="padding-top: 10px;">
                                        <button type="submit" class="btn btn-success">Modifier vos coordonnées</button>
                                        <button type="reset" class="btn btn-warning">Réinitiliser</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="offre">
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-offset-1 col-lg-7">
                                Vous êtes client de l'offre :
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password">
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-offset-1 col-lg-7">
                                <b>Modification de votre mot de passe.</b>

                                <form action="?case=ch_pwd" method="POST">
                                    <div class="input-group profilForm">
                                        <span class="input-group-addon input-lg">Nouveau mot de passe</span>
                                        <input type="password" class="form-control input-lg" name="dataPwd[pwd]"
                                               placeholder="Nouveau mot de passe">
                                    </div>
                                    <div class="input-group profilForm">
                                        <span
                                            class="input-group-addon input-lg">Confirmation du nouveau mot de passe</span>
                                        <input type="password" class="form-control input-lg" name="dataPwd[pwdConf]"
                                               placeholder="Confirmation du mot de passe" ">
                                    </div>
                                    <div class="text-center" style="padding-top: 10px;">
                                        <button type="submit" class="btn btn-success">Modifier mon mot de passe</button>
                                        <button type="reset" class="btn btn-warning">Réinitialiser</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#myTab a:last').tab('show');
                    })
                </script>
            </div>
        <?php
        break;
}
include '../includes/footer.php';