<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 11/08/13
 * Time: 16:09
 * To change this template use File | Settings | File Templates.
 */

$appName = "dl.abcloud.fr";
$titleBase = "dl.abcloud.fr";
//Version number
$version = "0.2";
//environement values : dev|test|prod
$env = 'dev';

// database configuration
$database = array(
    "server" => "localhost",
    "username" => "dev-dl",
    "password" => "ouvremoi",
    "dbname" => "dl.abcloud.fr"
);

// database server connection
if ($env == 'dev') {
    $tmpSession = 0;
    $version .= " <b style='color: red;'>dev</b>";
    try {
        $bdd = new PDO('mysql:host=' . $database['server'] . ';dbname=' . $database['dbname'], $database['username'], $database['password']);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $utf8 = $bdd->query("SET NAMES UTF8") or die (print_r($bdd->errorInfo()));
} elseif ($env == 'test') {
    $tmpSession = time() + 60 * 60;
    $version .= " <b style='color: red;'>test</b>";
} elseif ($emp == 'prod') {
    $tmpSession = time() + 60 * 60;
}