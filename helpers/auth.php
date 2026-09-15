<?php


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';




/*
==================================
AUTO LOGIN USING COOKIE
==================================
*/

function checkRememberMe()
{

    if (isset($_SESSION['user_id']))
    {
        return true;
    }


    if (isset($_COOKIE['remember_token']))
    {

        global $conn;


        $user =
            findUserByRememberToken(
                $conn,
                $_COOKIE['remember_token']
            );


        if ($user)
        {

            $_SESSION['user_id'] =
                $user['id'];


            $_SESSION['full_name'] =
                $user['full_name'];


            $_SESSION['email'] =
                $user['email'];


            $_SESSION['username'] =
                $user['username'];


            $_SESSION['role'] =
                $user['role'];


            return true;

        }

    }


    return false;

}






/*
==================================
CHECK LOGIN
==================================
*/

function isLoggedIn()
{

    if (isset($_SESSION['user_id']))
    {
        return true;
    }


    return checkRememberMe();

}






/*
==================================
REDIRECT BY ROLE
==================================
*/

function redirectByRole($role)
{

    switch ($role)
    {

        case 'manager':

            $page = 'manager-dashboard';

        break;


        case 'beautician':

            $page = 'beautician-dashboard';

        break;


        case 'customer':

            $page = 'customer-dashboard';

        break;


        case 'receptionist':

            $page = 'receptionist-dashboard';

        break;


        default:

            $page = 'dashboard';

        break;

    }


    header(
        "Location: index.php?page=" . $page
    );


    exit;

}






/*
==================================
LOGOUT
==================================
*/

function logoutUser()
{

    session_unset();

    session_destroy();


    if (isset($_COOKIE['remember_token']))
    {

        setcookie(
            "remember_token",
            "",
            time() - 3600,
            "/"
        );

    }

}

?>
