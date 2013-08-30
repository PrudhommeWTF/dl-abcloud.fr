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
    "dbname" => "dl_abcloud-fr"
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

//managed files extensions
$knownExt = array(
    'css' => 'Feuille de style',
    'doc' => 'Microsoft Word',
    'docx' => 'Microsoft Word',
    'flv' => 'Fichier FLV',
    'gif' => 'Image GIF',
    'html' =>'Page web',
    'jpeg' => 'Image JPEG',
    'jpg' => 'Image JPEG',
    'mov' => 'Fichier MOV',
    'mp4' => 'Fichier MP4',
    'mpeg' => 'Fichier MPEG',
    'pdf' => 'Adobe Acrobat',
    'php' => 'Script PHP',
    'png' => 'Image PNG',
    'ppt' => 'Microsoft Power Point',
    'pptx' => 'Microsoft Power Point',
    'rar' => 'Archive WinRar',
    'swf' => 'Fichier SWF',
    'txt' => 'Document texte',
    'wmv' => 'Fichier WMV',
    'xls' => 'Microsoft Excel',
    'xlsx' => 'Microsoft Excel',
    'zip' => 'Archive WinZip',
    'torrent' => 'Fichier Torrent'
);

//  repertoires a ne pas montrer
$t_repertoires_sensibles = array(
    'thumbnail'
);

//  listing des fichiers a ne pas montrer
$t_fichiers_sensibles = array(
    '.htaccess'
);