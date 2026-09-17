<?php


/*
==================================
ADD SAFETY ALERT (MANUAL)
==================================
*/

function addAlert(
    $conn,
    $customer,
    $allergy,
    $note
)
{


    $query = "

    INSERT INTO safety_alerts

    (
        customer_id,
        allergy_name,
        note,
        status
    )

    VALUES

    (?,?,?,'pending')

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "iss",
        $customer,
        $allergy,
        $note
    );


    return mysqli_stmt_execute($stmt);

}






/*
==================================
CREATE SAFETY ALERT FROM APPOINTMENT
==================================
*/

function createAlertFromAppointment(
    $conn,
    $appointmentId
)
{


    $query = "

    INSERT INTO safety_alerts

    (
        appointment_id,
        customer_id,
        allergy_name,
        note,
        status
    )


    SELECT

        id,

        customer_id,

        safety_note,

        safety_note,

        'pending'


    FROM appointments


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
        $appointmentId
    );



    return mysqli_stmt_execute($stmt);

}






/*
==================================
GET ALL ALERTS
==================================
*/

function getAllAlerts($conn)
{


    $query = "

    SELECT

    safety_alerts.*,

    users.full_name AS customer_name,

    services.service_name,

    appointments.appointment_date,

    appointments.appointment_time


    FROM safety_alerts


    LEFT JOIN users

    ON safety_alerts.customer_id = users.id


    LEFT JOIN appointments

    ON safety_alerts.appointment_id = appointments.id


    LEFT JOIN services

    ON appointments.service_id = services.id


    ORDER BY safety_alerts.id DESC

    ";



    $result =
        mysqli_query(
            $conn,
            $query
        );



    $alerts = [];



    while($row =
        mysqli_fetch_assoc($result))
    {

        $alerts[] = $row;

    }



    return $alerts;

}






/*
==================================
DELETE ALERT
==================================
*/

function deleteAlertData(
    $conn,
    $id
)
{


    $query = "

    DELETE FROM safety_alerts

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