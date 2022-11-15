<?php
function user_is_admin()
{
    if (isset($_SESSION[SESSION_NAME]['id_user'])  && !empty($_SESSION[SESSION_NAME]['id_user'])) {
        $isAdmin = squery("SELECT 1 FROM t_user WHERE id=" . $_SESSION[SESSION_NAME]['id_user'] . " AND isAdmin=1");
        if ($isAdmin) {
            return true;
        }
    }
}
