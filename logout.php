<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 13/08/13
 * Time: 00:33
 * To change this template use File | Settings | File Templates.
 */

include 'includes/sessionCheck.php';

setcookie('sessionStat', '', time(), null, null, false, true);
setcookie('sessionName', '', time(), null, null, false, true);
header('Location: /');