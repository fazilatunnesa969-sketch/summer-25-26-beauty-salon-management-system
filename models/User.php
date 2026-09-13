<?php


class User
{

    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }




    /*
    ==================================
    CREATE USER
    ==================================
    */

    public function createUser(
        $fullName,
        $email,
        $username,
        $password,
        $role,
        $permissionCode
    )
    {


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
                $this->conn,
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

    public function findByEmail($email)
    {

        $query = "

            SELECT *
            FROM users
            WHERE email = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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

    public function findByUsername($username)
    {

        $query = "

            SELECT *
            FROM users
            WHERE username = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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
    Email OR Username
    ==================================
    */

    public function findByLogin($login)
    {


        $query = "

            SELECT *
            FROM users
            WHERE email = ?
            OR username = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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

    public function getUserById($id)
    {


        $query = "

            SELECT *
            FROM users
            WHERE id = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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
    REMEMBER TOKEN UPDATE
    ==================================
    */

    public function updateRememberToken($id, $token)
    {
    

        $query = "

            UPDATE users

            SET remember_token = ?

            WHERE id = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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

    public function findByRememberToken($token)
    {
    

        $query = "

            SELECT *

            FROM users

            WHERE remember_token = ?

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
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



}

?>