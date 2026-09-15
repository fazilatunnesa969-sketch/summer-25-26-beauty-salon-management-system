<?php


/*
==================================
GET CUSTOMER APPOINTMENTS
==================================
*/

function getAppointments(
    $conn,
    $customerId
)
{


    $query = "

    SELECT

    appointments.*,

    services.service_name


    FROM appointments


    LEFT JOIN services

    ON appointments.service_id = services.id


    WHERE appointments.customer_id = ?


    ORDER BY appointments.id DESC


    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    $appointments = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $appointments[] = $row;

    }


    return $appointments;


}








/*
==================================
GET UPCOMING APPOINTMENTS
==================================
*/

function getUpcomingAppointments(
    $conn,
    $customerId
)
{


    $query = "

    SELECT


    appointments.*,

    services.service_name,

    services.price,

    services.duration


    FROM appointments


    LEFT JOIN services

    ON appointments.service_id = services.id


    WHERE appointments.customer_id = ?


    AND appointments.status != 'completed'


    ORDER BY appointments.appointment_date ASC


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    $appointments = [];


    while($row =
        mysqli_fetch_assoc($result))
    {


        $appointments[] = $row;


    }


    return $appointments;


}








/*
==================================
SEARCH APPOINTMENTS
==================================
*/

function searchCustomerAppointments(
    $conn,
    $customerId,
    $keyword
)
{


    $search =
        "%".$keyword."%";



    $query = "

    SELECT


    appointments.*,

    services.service_name,

    services.price,

    services.duration



    FROM appointments



    LEFT JOIN services

    ON appointments.service_id = services.id



    WHERE appointments.customer_id = ?



    AND appointments.status != 'completed'


    AND

    (

    appointments.id LIKE ?

    OR services.service_name LIKE ?

    OR appointments.appointment_date LIKE ?

    )


    ORDER BY appointments.id DESC


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "isss",
        $customerId,
        $search,
        $search,
        $search
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    $appointments = [];


    while($row =
        mysqli_fetch_assoc($result))
    {


        $appointments[] = $row;


    }


    return $appointments;


}/*
==================================
CANCEL APPOINTMENT
==================================
*/

function cancelCustomerAppointment(
    $conn,
    $appointmentId,
    $customerId
)
{


    $query = "

    UPDATE appointments

    SET status='cancelled'

    WHERE id = ?

    AND customer_id = ?

    AND status != 'completed'

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $appointmentId,
        $customerId
    );



    mysqli_stmt_execute($stmt);



    if(
        mysqli_stmt_affected_rows($stmt) > 0
    )
    {

        return true;

    }



    return false;


}








/*
==================================
GET ACTIVE SERVICES
==================================
*/

function getCustomerServices($conn)
{


    $query = "

    SELECT *

    FROM services

    WHERE status='active'

    ORDER BY id ASC

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
GET SINGLE SERVICE
==================================
*/

function getServiceById(
    $conn,
    $serviceId
)
{


    $query = "

    SELECT *

    FROM services

    WHERE id = ?

    LIMIT 1

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $serviceId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    return mysqli_fetch_assoc($result);


}








/*
==================================
CREATE CUSTOMER ACCOUNT
==================================
*/

function createCustomer(
    $conn,
    $fullName,
    $email,
    $phone,
    $password
)
{


    $check = "

    SELECT id

    FROM users

    WHERE email = ?

    LIMIT 1

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $check
        );



    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    if(mysqli_num_rows($result) > 0)
    {


        $user =
            mysqli_fetch_assoc($result);



        return $user['id'];


    }







    $username =

        strtolower(
            str_replace(
                ' ',
                '',
                $fullName
            )
        )

        . rand(100,999);






    $passwordHash =

        password_hash(
            $password,
            PASSWORD_DEFAULT
        );






    $role = "customer";


    $status = "active";






    $query = "

    INSERT INTO users

    (

    full_name,

    email,

    phone,

    username,

    password_hash,

    role,

    status

    )


    VALUES

    (?,?,?,?,?,?,?)

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $fullName,
        $email,
        $phone,
        $username,
        $passwordHash,
        $role,
        $status
    );



    mysqli_stmt_execute($stmt);



    return mysqli_insert_id($conn);


}/*
==================================
CREATE APPOINTMENT
==================================
*/

function createCustomerAppointment(
    $conn,
    $customerId,
    $serviceId,
    $date,
    $time,
    $safetyNote
)
{


    $query = "

    INSERT INTO appointments

    (

    customer_id,

    service_id,

    appointment_date,

    appointment_time,

    safety_note,

    status,

    payment_status

    )


    VALUES

    (?,?,?,?,?,?,?)

    ";



    $status = "pending";


    $paymentStatus = "pending";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "iisssss",
        $customerId,
        $serviceId,
        $date,
        $time,
        $safetyNote,
        $status,
        $paymentStatus
    );



    if(
        mysqli_stmt_execute($stmt)
    )
    {

        return mysqli_insert_id($conn);

    }



    return false;


}








/*
==================================
GET LAST APPOINTMENT
==================================
*/

function getLastAppointment(
    $conn,
    $customerId
)
{


    $query = "

    SELECT *

    FROM appointments

    WHERE customer_id = ?

    ORDER BY id DESC

    LIMIT 1

    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    return mysqli_fetch_assoc($result);


}








/*
==================================
CREATE PAYMENT
==================================
*/

function createPayment(
    $conn,
    $customerId,
    $appointmentId,
    $amount,
    $method,
    $transactionId
)
{


    $query = "

    INSERT INTO payments

    (

    customer_id,

    appointment_id,

    amount,

    payment_method,

    transaction_id,

    status

    )


    VALUES

    (?,?,?,?,?,?)

    ";



    $status = "paid";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "iidsss",
        $customerId,
        $appointmentId,
        $amount,
        $method,
        $transactionId,
        $status
    );



    return mysqli_stmt_execute($stmt);


}
/*
==================================
UPDATE PAYMENT STATUS
==================================
*/

function updateCustomerPaymentStatus(
    $conn,
    $appointmentId
)
{


    $query = "

    UPDATE appointments

    SET payment_status='paid'

    WHERE id=?

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
CREATE SAFETY ALERT
==================================
*/

function createSafetyAlert(
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
GET CUSTOMER PROFILE
==================================
*/

function getProfile(
    $conn,
    $customerId
)
{


    $query = "

    SELECT


    users.id AS customer_id,

    users.full_name,

    users.email,

    users.phone,


    appointments.id AS appointment_id,

    appointments.appointment_date,

    appointments.appointment_time,


    services.service_name


    FROM users


    LEFT JOIN appointments

    ON users.id = appointments.customer_id


    LEFT JOIN services

    ON appointments.service_id = services.id


    WHERE users.id = ?


    ORDER BY appointments.id DESC


    LIMIT 1


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    $data =
        mysqli_fetch_assoc($result);



    return $data ?: [];


}








/*
==================================
GET CUSTOMER INFO
==================================
*/

function getCustomerInfo(
    $conn,
    $customerId
)
{


    $query = "

    SELECT

    id,

    full_name,

    email,

    phone


    FROM users


    WHERE id = ?


    LIMIT 1


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    return mysqli_fetch_assoc($result);


}








/*
==================================
GET PROFILE HISTORY
==================================
*/

function getProfileHistory(
    $conn,
    $customerId
)
{


    $query = "

    SELECT


    appointments.id AS appointment_id,

    appointments.appointment_date,

    appointments.appointment_time,

    appointments.status,

    appointments.payment_status,


    services.service_name,

    services.price,

    services.duration



    FROM appointments



    LEFT JOIN services

    ON appointments.service_id = services.id



    WHERE appointments.customer_id = ?


    AND appointments.status = 'completed'


    ORDER BY appointments.id DESC


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    $appointments = [];



    while($row =
        mysqli_fetch_assoc($result))
    {


        $appointments[] = $row;


    }



    return $appointments;


}
/*
==================================
RESCHEDULE APPOINTMENT
==================================
*/

function rescheduleCustomerAppointment(
    $conn,
    $id,
    $customerId,
    $date,
    $time
)
{


    $query = "

    UPDATE appointments

    SET

    appointment_date=?,

    appointment_time=?,

    status='pending'


    WHERE id=?

    AND customer_id=?


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "ssii",
        $date,
        $time,
        $id,
        $customerId
    );



    return mysqli_stmt_execute($stmt);


}








/*
==================================
GET NEXT RECOMMENDED VISIT
==================================
*/

function getNextRecommendedVisit(
    $conn,
    $customerId
)
{


    $query = "

    SELECT *

    FROM follow_ups

    WHERE customer_id = ?

    ORDER BY follow_up_date ASC

    LIMIT 1


    ";



    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $customerId
    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    return mysqli_fetch_assoc($result);


}


?>
