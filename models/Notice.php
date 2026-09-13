<?php


class Notice
{


    private $conn;



    public function __construct($conn)
    {

        $this->conn = $conn;

    }






    /*
    ==================================
    CREATE NOTICE
    ==================================
    */


    public function createNotice(
        $title,
        $message,
        $createdBy,
        $receiverRole
    )
    {
    
    
        $query = "
    
        INSERT INTO notices
    
        (
            title,
            message,
            created_by,
            receiver_role
        )
    
    
        VALUES
    
        (?,?,?,?)
    
        ";
    
    
    
        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );
    
    
    
        mysqli_stmt_bind_param(
            $stmt,
            "ssis",
            $title,
            $message,
            $createdBy,
            $receiverRole
        );
    
    
    
        return mysqli_stmt_execute($stmt);
    
    
    }







    /*
    ==================================
    GET ALL NOTICES
    ==================================
    */

    public function getAllNotices()
    {
    
    
    $query = "
    
    SELECT 
    
    notices.*,
    
    users.full_name AS creator_name
    
    
    FROM notices
    
    
    LEFT JOIN users
    
    ON notices.created_by = users.id
    
    
    ORDER BY notices.id DESC
    
    
    ";
    
    
    
    $result = mysqli_query(
        $this->conn,
        $query
    );
    
    
    
    $notices = [];
    
    
    
    while($row = mysqli_fetch_assoc($result))
    {
    
    
        $notices[] = $row;
    
    
    }
    
    
    
    return $notices;
    
    
    }
 /*
==================================
GET BEAUTICIAN NOTICES
==================================
*/

public function getBeauticianNotices()
{


$query = "

SELECT 

notices.*,

users.full_name AS creator_name


FROM notices


LEFT JOIN users

ON notices.created_by = users.id


WHERE notices.receiver_role = ?


ORDER BY notices.id DESC


";


$stmt = mysqli_prepare(
    $this->conn,
    $query
);



$role = "beautician";


mysqli_stmt_bind_param(
    $stmt,
    "s",
    $role
);



mysqli_stmt_execute($stmt);



$result = mysqli_stmt_get_result($stmt);



$notices = [];



while($row = mysqli_fetch_assoc($result))
{


    $notices[] = $row;


}



return $notices;



}




    /*
    ==================================
    DELETE NOTICE
    ==================================
    */


    public function deleteNotice($id)
    {


        $query = "

        DELETE FROM notices

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



        return mysqli_stmt_execute($stmt);


    }




}

?>