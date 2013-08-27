<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 12/08/13
 * Time: 18:31
 * To change this template use File | Settings | File Templates.
 */

include 'includes/sessionCheck.php';
include 'includes/header.php';
include 'includes/namesCheck.php';

//breadcrumb - where am I ?

?>
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">1er sous dossier</a></li>
        <li class="active">Sous dossier actuel</li>
    </ol>
<?php

//list content directory

?>

<?php
include 'includes/footer.php';
?>