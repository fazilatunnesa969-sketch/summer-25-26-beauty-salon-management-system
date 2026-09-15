<?php


/*
==================================
GET ALL SERVICES
==================================
*/

function getAllServices($conn)
{

    $query = "
        SELECT *
        FROM services
        ORDER BY id DESC
    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $services = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $services[] = $row;

    }


    return $services;

}






/*
==================================
CREATE SERVICE
==================================
*/

function createService(
    $conn,
    $name,
    $category,
    $price,
    $duration
)
{


    $status = "active";


    $query = "
        INSERT INTO services
        (
            service_name,
            category,
            price,
            duration,
            status
        )

        VALUES
        (?, ?, ?, ?, ?)
    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "ssdss",
        $name,
        $category,
        $price,
        $duration,
        $status
    );


    return mysqli_stmt_execute($stmt);

}






/*
==================================
DELETE SERVICE
==================================
*/

function deleteService(
    $conn,
    $id
)
{


    $query = "
        DELETE FROM services
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


    return mysqli_stmt_execute($stmt);

}


?>
