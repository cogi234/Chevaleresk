<?php
// Default time out is 1440 seconds
// http://php.net/session.gc-maxlifetime
//
date_default_timezone_set('US/Eastern');

session_start();
function delete_session()
{
    session_destroy(); // effacer le fichier ../wamp64/tmp/sess_PHPSESSID
    session_start();
}
function redirect($url)
{
    header('location:' . $url);
    exit();
}
function userAccess($timeout = defaultTimeout)
{
    if (!is_connected())
        redirect('forbidden.php');
}
function adminAccess($timeout = defaultTimeout)
{
    if (!is_connected() || !isset($_SESSION['isAdmin']) || !(bool)$_SESSION["isAdmin"])
        redirect('forbidden.php');
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/26
 * Date of modification: 2024/03/26
 * @return bool Is the user connected 
 */
function is_connected(): bool
{
    $CONNECTION_STATUS = "connected";

    return isset($_SESSION[$CONNECTION_STATUS]) && $_SESSION[$CONNECTION_STATUS] == true;
}