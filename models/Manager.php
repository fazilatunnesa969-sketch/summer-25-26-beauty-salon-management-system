<?php


/*
==================================
GET TOTAL EMPLOYEES
==================================
*/

function getTotalEmployees($conn)
{

    $query = "

    SELECT COUNT(*) AS total
    FROM users
    WHERE role != 'customer'

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $row =
        mysqli_fetch_assoc($result);


    return $row['total'];

}






/*
==================================
GET ALL EMPLOYEES
==================================
*/

function getAllEmployees($conn)
{


    $query = "

        SELECT *
        FROM users
        WHERE role != 'manager'
        ORDER BY id DESC

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $employees = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $employees[] = $row;

    }


    return $employees;

}






/*
==================================
SEARCH EMPLOYEES
==================================
*/

function searchEmployees(
    $conn,
    $keyword
)
{

    $keyword =
        "%".$keyword."%";


    $query = "

    SELECT *
    FROM users

    WHERE

    (
        full_name LIKE ?
        OR email LIKE ?
        OR username LIKE ?
    )

    AND role != 'manager'

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $keyword,
        $keyword,
        $keyword
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    $employees = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $employees[] = $row;

    }


    return $employees;

}






/*
==================================
DELETE EMPLOYEE
==================================
*/

function deleteEmployeeData(
    $conn,
    $id
)
{


    $query = "

    DELETE FROM users
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






/*
==================================
GET EMPLOYEE BY ID
==================================
*/

function getEmployeeById(
    $conn,
    $id
)
{


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
UPDATE EMPLOYEE
==================================
*/

function updateEmployeeData(
    $conn,
    $id,
    $name,
    $email,
    $username,
    $role,
    $status
)
{


    $query = "

    UPDATE users

    SET
    full_name=?,
    email=?,
    username=?,
    role=?,
    status=?

    WHERE id=?

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $name,
        $email,
        $username,
        $role,
        $status,
        $id
    );


    return mysqli_stmt_execute($stmt);

}






/*
==================================
CREATE EMPLOYEE
==================================
*/

function createEmployee(
    $conn,
    $name,
    $email,
    $username,
    $password,
    $role
)
{


    $hash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    $status = "active";


    $query = "

    INSERT INTO users

    (
        full_name,
        email,
        username,
        password_hash,
        role,
        status
    )

    VALUES
    (?,?,?,?,?,?)

    ";


    $stmt =
        mysqli_prepare(
            $conn,
            $query
        );


    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $name,
        $email,
        $username,
        $hash,
        $role,
        $status
    );


    return mysqli_stmt_execute($stmt);

}
/*
==================================
TOTAL REVENUE
==================================
*/

function getTotalRevenue($conn)
{

    $query = "

    SELECT SUM(amount) AS total
    FROM payments

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $row =
        mysqli_fetch_assoc($result);


    return $row['total'] ?? 0;

}






/*
==================================
MONTHLY REVENUE
==================================
*/

function getMonthlyRevenue($conn)
{

    $query = "

    SELECT SUM(amount) AS total

    FROM payments

    WHERE MONTH(payment_date)
    =
    MONTH(CURRENT_DATE())

    AND YEAR(payment_date)
    =
    YEAR(CURRENT_DATE())

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $row =
        mysqli_fetch_assoc($result);


    return $row['total'] ?? 0;

}






/*
==================================
TOTAL BOOKINGS
==================================
*/

function getTotalBookings($conn)
{

    $query = "

    SELECT COUNT(*) AS total

    FROM appointments

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $row =
        mysqli_fetch_assoc($result);


    return $row['total'] ?? 0;

}






/*
==================================
EMPLOYEE PERFORMANCE RANKING
==================================
*/

function getEmployeeRanking($conn)
{

    $query = "

    SELECT

        users.full_name,

        COUNT(appointments.id) AS total_services,

        COALESCE(
            SUM(payments.amount),
            0
        ) AS total_revenue


    FROM users


    LEFT JOIN appointments

    ON users.id = appointments.beautician_id


    LEFT JOIN payments

    ON appointments.id = payments.appointment_id


    WHERE users.role = 'beautician'


    GROUP BY users.id


    ORDER BY total_revenue DESC

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $ranking = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $ranking[] = $row;

    }


    return $ranking;

}






/*
==================================
PEAK HOUR ANALYSIS
==================================
*/

function getPeakHourAnalysis($conn)
{

    $query = "

    SELECT

        appointment_time,

        COUNT(id) AS total_bookings


    FROM appointments


    GROUP BY HOUR(appointment_time)


    ORDER BY total_bookings DESC

    ";


    $result =
        mysqli_query(
            $conn,
            $query
        );


    $peakHours = [];


    while($row =
        mysqli_fetch_assoc($result))
    {

        $peakHours[] = $row;

    }


    return $peakHours;

}

?>