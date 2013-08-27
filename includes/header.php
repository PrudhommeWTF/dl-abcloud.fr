<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 11/08/13
 * Time: 01:23
 * To change this template use File | Settings | File Templates.
 */
require_once 'config.php';
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/assets/ico/favicon.png" type="image/x-icon">

        <title><?php echo $titleBase . ' - Nouvelle version'; ?></title>

        <link href="/assets/css/perso.css" rel="stylesheet">
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/bootstrap/css/bootstrap-glyphicons.css" rel="stylesheet">
        <?php
        if ($_SERVER['PHP_SELF'] == '/index.php') {
            ?>
            <link href="/bootstrap/css/carousel.css" rel="stylesheet">
        <?php
        }
        ?>
    </head>
<body>
    <!-- Navbar -->
    <div class="navbar navbar-fixed-top">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand"
               href="<?php if (isset($_COOKIE['sessionStat']) && $_COOKIE['sessionStat'] == md5('logged')) {
                   echo '/home.php';
               } else {
                   echo '/';
               } ?>"><?php echo $appName; ?></a>

            <div class="nav-collapse collapse">
                <?php
                if (isset($_COOKIE['sessionName'])) {
                    $req = $bdd->query("SELECT * FROM dl_users WHERE userUID = '" . $_COOKIE['sessionName'] . "'") or die (print_r($bdd->errorInfo()));
                    $data = $req->fetch(PDO::FETCH_OBJ);
                }
                if ($_SERVER['PHP_SELF'] == '/index.php') {
                    ?>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php if (isset($_COOKIE['sessionStat']) && $_COOKIE['sessionStat'] == md5('logged')) {
                                echo 'home.php';
                            } else {
                                echo '#';
                            } ?>">Accueil</a></li>
                        <li><a href="#about">À propos du service</a></li>
                        <li><a href="#tarifs">Les tarifs</a></li>
                        <li><a href="#contacts">Nous contacter</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php
                        if (!isset($_COOKIE['sessionName'])) {
                            ?>
                            <li><a href="/register.php">S'enregistrer</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Se connecter <strong
                                        class="caret"></strong></a>

                                <div class="dropdown-menu" style="padding: 15px;">
                                    <form method="post" action="/login.php" accept-charset="UTF-8">
                                        <input class="loginInput" type="text" placeholder="Votre email" id="mail"
                                               name="login[mail]">
                                        <input class="loginInput" type="password" placeholder="Votre mot de passe"
                                               id="password" name="login[password]">
                                        <input class="btn btn-primary btn-block" type="submit" id="sign-in"
                                               name="login[submit]" value="Me connecter">
                                    </form>
                                </div>
                            </li>
                        <?php
                        } else {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"
                                   data-toggle="dropdown">Bienvenue, <?php if (!empty($data->userFName)) {
                                        echo urldecode($data->userFName);
                                    } else {
                                        echo $data->userMail;
                                    } ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/user/profil.php"><span
                                                class="glyphicon glyphicon-user navbar-icons"></span> Votre profil</a>
                                    </li>
                                    <li><a href="/user/preferences.php"><span
                                                class="glyphicon glyphicon-cog navbar-icons"></span> Vos préférences</a>
                                    </li>
                                    <li><a href="/help/support"><span
                                                class="glyphicon glyphicon-envelope navbar-icons"></span> Contacter le
                                            support</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/logout.php"><span class="glyphicon glyphicon-off navbar-icons"></span>
                                            Déconnexion</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                } elseif ($_SERVER['PHP_SELF'] == '/home.php' || $_SERVER['PHP_SELF'] == '/upload.php' || $_SERVER['PHP_SELF'] == '/user/profil.php' || $_SERVER['PHP_SELF'] == '/user/preferences.php') {
                    ?>
                    <ul class="nav navbar-nav">
                        <li <?php if ($_SERVER['PHP_SELF'] == '/home.php') {
                            echo 'class="active"';
                        } ?>><a href="/home.php">Mes dossiers</a></li>
                        <li <?php if ($_SERVER['PHP_SELF'] == '/upload.php') {
                            echo 'class="active"';
                        } ?>><a href="/upload.php">Importer des fichiers</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">Bienvenue, <?php if (!empty($data->userFName)) {
                                    echo urldecode($data->userFName);
                                } else {
                                    echo $data->userMail;
                                } ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/profil.php"><span
                                            class="glyphicon glyphicon-user navbar-icons"></span> Votre profil</a></li>
                                <li><a href="/user/preferences.php"><span
                                            class="glyphicon glyphicon-cog navbar-icons"></span> Vos préférences</a>
                                </li>
                                <li><a href="/help/support"><span
                                            class="glyphicon glyphicon-envelope navbar-icons"></span> Contacter le
                                        support</a></li>
                                <li class="divider"></li>
                                <li><a href="/logout.php"><span class="glyphicon glyphicon-off navbar-icons"></span>
                                        Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
<?php
if ($_SERVER['PHP_SELF'] != '/index.php') {
    ?>
    <div class="container">
    <?php
    }