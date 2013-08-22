<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 13/08/13
 * Time: 08:58
 * To change this template use File | Settings | File Templates.
 */

//session check
if (empty($_COOKIE['sessionStat']) || empty($_COOKIE['sessionName'])) {
    $url = '/index.php';
    header('Location: ' . $url);
}