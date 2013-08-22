<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 14/08/13
 * Time: 10:56
 * To change this template use File | Settings | File Templates.
 */

//si le nom et prénom son vide, afficher une alerte qui demande de se rendre dans /user/profile.php pour faire le changement
if (empty($data->userFName) || empty($data->userSName)) {
    ?>
    <div class="alert text-center">
        <strong>Attention !</strong>

        <p>Vous n'avez pas encore défini votre prénom et votre nom. Merci de vous rendre dans la configuration de votre
            profil pour faire le nécessaire.</p>
        <a class="btn btn-primary" href="/user/profil.php">Configuration de votre profil</a>
    </div>
<?php
}