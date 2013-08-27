<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 25/08/13
 * Time: 18:55
 * To change this template use File | Settings | File Templates.
 */
if(isset($_GET['toMD5'])){
    echo md5($_GET['toMD5']);
}
?>
<form action="" method="GET">
    <input type="text" id="toMD5" name="toMD5">
    <button type="submit">valider</button>
</form>