<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 22/08/13
 * Time: 10:59
 * To change this template use File | Settings | File Templates.
 */
include 'includes/header.php';

$req = $bdd->query("SELECT * FROM dl_users WHERE userUID = '" . $_COOKIE['sessionName'] . "'") or die (print_r($bdd->errorInfo()));
$data = $req->fetch(PDO::FETCH_OBJ);
