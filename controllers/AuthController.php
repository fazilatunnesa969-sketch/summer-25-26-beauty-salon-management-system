<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/auth.php';


/*
==================================================
SIGNUP
==================================================
*/

function signup()
{
    global $conn;

    $errors = [];

    $fullName = "";
    $email = "";
    $username = "";
    $role = "";

    $success = isset($_GET['success']);


    /*
    ==============================================
    HANDLE SIGNUP FORM
    ==============================================
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $fullName =
            trim(
                $_POST['full_name'] ?? ''
            );

        $email =
            trim(
                $_POST['email'] ?? ''
            );

        $username =
            trim(
                $_POST['username'] ?? ''
            );

        $password =
            $_POST['password'] ?? '';

        $confirmPassword =
            $_POST['confirm_password'] ?? '';

        $role =
            $_POST['role'] ?? '';

        $permissionCode =
            trim(
                $_POST['permission_code'] ?? ''
            );


        /*
        ==========================================
        NAME VALIDATION
        ==========================================
        */

        if ($fullName === '') {

            $errors[] =
                "Full name is required.";

        }


        /*
        ==========================================
        EMAIL VALIDATION
        ==========================================
        */

        if ($email === '') {

            $errors[] =
                "Email is required.";

        }
        elseif (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $errors[] =
                "Invalid email address.";

        }


        /*
        ==========================================
        USERNAME VALIDATION
        ==========================================
        */

        if ($username === '') {

            $errors[] =
                "Username is required.";

        }
        elseif (strlen($username) < 4) {

            $errors[] =
                "Username must be at least 4 characters.";

        }


        /*
        ==========================================
        PASSWORD VALIDATION
        ==========================================
        */

        if ($password === '') {

            $errors[] =
                "Password is required.";

        }
        elseif (strlen($password) < 8) {

            $errors[] =
                "Password must be at least 8 characters.";

        }


        if ($password !== $confirmPassword) {

            $errors[] =
                "Passwords do not match.";

        }


        /*
        ==========================================
        ROLE VALIDATION
        ==========================================
        */

        $allowedRoles = [

            'receptionist',
            'beautician'

        ];


        /*
        ==========================================
        MANAGER PERMISSION CODE
        ==========================================
        */

        if (empty($errors)) {

            if ($permissionCode === '') {

                $errors[] =
                    "Manager permission code is required.";

            }
            elseif (
                $permissionCode !== "LM2026"
            ) {

                $errors[] =
                    "Invalid manager permission code.";

            }

        }


        /*
        ==========================================
        CHECK EMAIL
        ==========================================
        */

        if (empty($errors)) {

            $existingEmail =
                findUserByEmail(
                    $conn,
                    $email
                );


            if ($existingEmail) {

                $errors[] =
                    "Email already exists.";

            }

        }


        /*
        ==========================================
        CHECK USERNAME
        ==========================================
        */

        if (empty($errors)) {

            $existingUsername =
                findUserByUsername(
                    $conn,
                    $username
                );


            if ($existingUsername) {

                $errors[] =
                    "Username already exists.";

            }

        }


        /*
        ==========================================
        CREATE ACCOUNT
        ==========================================
        */

        if (empty($errors)) {

            $created =
                createUser(
                    $conn,
                    $fullName,
                    $email,
                    $username,
                    $password,
                    $role,
                    $permissionCode
                );


            if ($created) {

                header(
                    "Location: index.php?page=signup&success=1"
                );

                exit;

            }
            else {

                $errors[] =
                    "Account creation failed.";

            }

        }

    }


    /*
    ==========================================
    LOAD SIGNUP VIEW
    ==========================================
    */

    require __DIR__ .
        '/../views/signup.php';
}



/*
==================================================
LOGIN
==================================================
*/

function login()
{
    global $conn;


    /*
    ==========================================
    CHECK ALREADY LOGGED IN
    ==========================================
    */

    if (isLoggedIn()) {

        redirectByRole(
            $_SESSION['role']
        );

        exit;

    }


    $loginError = "";

    $loginValue = "";


    /*
    ==========================================
    HANDLE LOGIN FORM
    ==========================================
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $loginValue =
            trim(
                $_POST['login'] ?? ''
            );

        $password =
            $_POST['password'] ?? '';


        /*
        ==========================================
        REQUIRED FIELD VALIDATION
        ==========================================
        */

        if (
            $loginValue === '' ||
            $password === ''
        ) {

            $loginError =
                "Please fill in all fields.";

        }
        else {


            /*
            ======================================
            FIND USER
            ======================================
            */

            $user =
                findUserByLogin(
                    $conn,
                    $loginValue
                );


            /*
            ======================================
            VERIFY PASSWORD
            ======================================
            */

            if (
                $user &&
                password_verify(
                    $password,
                    $user['password_hash']
                )
            ) {


                /*
                ==================================
                CHECK ACCOUNT STATUS
                ==================================
                */

                if (
                    ($user['status'] ?? 'active')
                    !== 'active'
                ) {

                    $loginError =
                        "Your account is inactive.";

                }
                else {


                    /*
                    ==============================
                    START LOGIN SESSION
                    ==============================
                    */

                    session_regenerate_id(true);


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


                    /*
                    ==============================
                    REMEMBER ME
                    ==============================
                    */

                    if (
                        isset(
                            $_POST['remember_me']
                        )
                    ) {

                        $token =
                            bin2hex(
                                random_bytes(32)
                            );


                        updateRememberToken(
                            $conn,
                            $user['id'],
                            $token
                        );


                        setcookie(
                            "remember_token",
                            $token,
                            time() + (86400 * 30),
                            "/"
                        );

                    }


                    /*
                    ==============================
                    REDIRECT BASED ON ROLE
                    ==============================
                    */

                    redirectByRole(
                        $user['role']
                    );

                    exit;

                }

            }
            else {

                $loginError =
                    "Invalid email/username or password.";

            }

        }

    }


    /*
    ==========================================
    LOAD LOGIN VIEW
    ==========================================
    */

    require __DIR__ .
        '/../views/login.php';
}
