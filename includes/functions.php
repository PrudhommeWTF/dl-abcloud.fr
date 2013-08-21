<?php
function pwdValidator($password) {
    if (strlen($password)>=4)
        return true;
    else
        return false;
}

function mailValidator($mail) {
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false)
        return true;
    else
        return false;
}
?>