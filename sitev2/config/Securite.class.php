<?php
require_once("config.php");
class Securite
{
    public static function secureHTML($string)
    {
        return htmlentities($string);
    }

    public static function generateSecuredCookie()
    {
        $token = session_id() . microtime() . rand(0, 999999);
        $token = hash("sha512", $token);
        setcookie(COOKIE_PROTECT, $token, time() + (60 * 20));
        $_SESSION[COOKIE_PROTECT] = $token;
    }

    public static function cookieVerification()
    {
        if (isset($_COOKIE[COOKIE_PROTECT]) && isset($_SESSION[COOKIE_PROTECT])) {
            if ($_COOKIE[COOKIE_PROTECT] === $_SESSION[COOKIE_PROTECT]) {
                Securite::generateSecuredCookie();
                return true;
            } else {
                session_destroy();
                throw new Exception("Vous n'avez pas les droits requis pour accéder à cette page.");
                return false;
            }
        }
    }

    public static function verificationAccessSession()
    {
        return (isset($_SESSION['access']) && !empty($_SESSION['access']) && $_SESSION['access'] === "admin");
    }

    public static function verificationLoginAndPassword()
    {
        return (isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['password']) && !empty($_POST['password']));
    }
}
