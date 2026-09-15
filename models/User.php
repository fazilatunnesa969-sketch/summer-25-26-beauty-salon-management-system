<?php


/*
==================================
CREATE USER
==================================
*/

function createUser(
    $conn,
    $fullName,
    $email,
    $username,
    $password,
    $role,
    $permissionCode
) {

    $passwordHash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    $status = "active";

    $approvalStatus = "approved";


    $query = "

        INSERT INTO users
        (
            full_name,
            email,
            username,
            password_hash,
            role,
            status,
            approval_status,
            permission_code
        )

        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?)

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $fullName,
        $email,
        $username,
        $passwordHash,
        $role,
        $status,
        $approvalStatus,
        $permissionCode
    );


    return mysqli_stmt_execute($stmt);
}



/*
==================================
FIND USER BY EMAIL
==================================
*/

function findUserByEmail(
    $conn,
    $email
) {

    $query = "

        SELECT *
        FROM users
        WHERE email = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    return mysqli_fetch_assoc($result);
}



/*
==================================
FIND USER BY USERNAME
==================================
*/

function findUserByUsername(
    $conn,
    $username
) {

    $query = "

        SELECT *
        FROM users
        WHERE username = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    return mysqli_fetch_assoc($result);
}



/*
==================================
LOGIN SEARCH
EMAIL OR USERNAME
==================================
*/

function findUserByLogin(
    $conn,
    $login
) {

    $query = "

        SELECT *
        FROM users
        WHERE email = ?
        OR username = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $login,
        $login
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    return mysqli_fetch_assoc($result);
}



/*
==================================
GET USER BY ID
==================================
*/

function getUserById(
    $conn,
    $id
) {

    $query = "

        SELECT *
        FROM users
        WHERE id = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    return mysqli_fetch_assoc($result);
}



/*
==================================
UPDATE REMEMBER TOKEN
==================================
*/

function updateRememberToken(
    $conn,
    $id,
    $token
) {

    $query = "

        UPDATE users

        SET remember_token = ?

        WHERE id = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $token,
        $id
    );


    return mysqli_stmt_execute($stmt);
}



/*
==================================
FIND USER BY REMEMBER TOKEN
==================================
*/

function findUserByRememberToken(
    $conn,
    $token
) {

    $query = "

        SELECT *
        FROM users

        WHERE remember_token = ?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $token
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    return mysqli_fetch_assoc($result);
}

?>
