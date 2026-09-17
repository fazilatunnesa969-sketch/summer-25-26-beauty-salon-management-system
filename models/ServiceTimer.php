<?php


/*
==================================
START SERVICE TIMER
==================================
*/

function startServiceTimer(
    $conn,
    $beautician,
    $customer,
    $service
)
{


    $query = "

    INSERT INTO service_timer

    (
        beautician_id,
        customer_id,
        service_name,
        start_time,
        status
    )


    VALUES

    (?,?,?,NOW(),'running')

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "iis",
        $beautician,
        $customer,
        $service
    );



    return mysqli_stmt_execute($stmt);


}








/*
==================================
GET RUNNING SERVICES
FOR BEAUTICIAN
==================================
*/

function getRunningServices(
    $conn,
    $beauticianId
)
{


    $query = "

    SELECT *

    FROM service_timer

    WHERE status = 'running'

    AND beautician_id = ?

    ORDER BY id DESC

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $beauticianId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



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
COMPLETE SERVICE TIMER
==================================
*/

function completeServiceTimer(
    $conn,
    $id
)
{


    /*
    ==========================
    UPDATE TIMER
    ==========================
    */


    $query = "

    UPDATE service_timer

    SET

    end_time = NOW(),

    status = 'completed'

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



    $timerUpdated =
        mysqli_stmt_execute($stmt);






    /*
    ==========================
    UPDATE APPOINTMENT STATUS
    ==========================
    */


    if($timerUpdated)
    {


        $query2 = "

        UPDATE appointments

        INNER JOIN service_timer

        ON appointments.customer_id =
           service_timer.customer_id


        SET appointments.status = 'completed'


        WHERE service_timer.id = ?


        AND service_timer.status = 'completed'


        AND appointments.status = 'in_service'


        ";



        $stmt2 =
            mysqli_prepare(
                $conn,
                $query2
            );



        mysqli_stmt_bind_param(
            $stmt2,
            "i",
            $id
        );



        mysqli_stmt_execute($stmt2);


    }



    return $timerUpdated;


}


?>