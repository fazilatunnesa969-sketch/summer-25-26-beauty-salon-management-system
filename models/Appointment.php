<?php


class Appointment
{


    private $conn;



    public function __construct($conn)
    {

        $this->conn = $conn;

    }







    /*
    ==================================
    GET ALL APPOINTMENTS
    ==================================
    */


    public function getAllAppointments()
    {


        $query = "

        SELECT

        appointments.*,

        customer.full_name AS customer_name,

        beautician.full_name AS beautician_name,

        services.service_name



        FROM appointments



        LEFT JOIN users customer

        ON appointments.customer_id = customer.id



        LEFT JOIN users beautician

        ON appointments.beautician_id = beautician.id



        LEFT JOIN services

        ON appointments.service_id = services.id



        ORDER BY appointments.id DESC

        ";



        $result =
            mysqli_query(
                $this->conn,
                $query
            );



        $appointments = [];



        while($row = mysqli_fetch_assoc($result))
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


    public function searchAppointments($keyword)
    {


        $keyword = "%" . $keyword . "%";



        $query = "

        SELECT

        appointments.*,

        customer.full_name AS customer_name,

        beautician.full_name AS beautician_name,

        services.service_name



        FROM appointments



        LEFT JOIN users customer

        ON appointments.customer_id = customer.id



        LEFT JOIN users beautician

        ON appointments.beautician_id = beautician.id



        LEFT JOIN services

        ON appointments.service_id = services.id



        WHERE

        customer.full_name LIKE ?

        OR beautician.full_name LIKE ?

        OR services.service_name LIKE ?

        OR appointments.status LIKE ?



        ORDER BY appointments.id DESC

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );



        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $keyword,
            $keyword,
            $keyword,
            $keyword
        );



        mysqli_stmt_execute($stmt);



        $result =
            mysqli_stmt_get_result($stmt);



        $appointments = [];



        while($row = mysqli_fetch_assoc($result))
        {

            $appointments[] = $row;

        }



        return $appointments;


    }









    /*
    ==================================
    CREATE APPOINTMENT
    ==================================
    */


    public function createAppointment(
        $customer,
        $beautician,
        $service,
        $date,
        $time
    )
    {


        $status = "pending";



        $query = "

        INSERT INTO appointments

        (

        customer_id,

        beautician_id,

        service_id,

        appointment_date,

        appointment_time,

        status

        )

        VALUES

        (?,?,?,?,?,?)

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );



        mysqli_stmt_bind_param(
            $stmt,
            "iiisss",
            $customer,
            $beautician,
            $service,
            $date,
            $time,
            $status
        );



        return mysqli_stmt_execute($stmt);


    }









    /*
    ==================================
    UPDATE APPOINTMENT STATUS
    ==================================
    */


    public function updateStatus(
        $id,
        $status
    )
    {


        $query = "

        UPDATE appointments

        SET status = ?

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
            $status,
            $id
        );



        return mysqli_stmt_execute($stmt);


    }
    /*
==================================
ASSIGN BEAUTICIAN AND CONFIRM
==================================
*/

public function assignBeautician(
    $appointmentId,
    $beauticianId
)
{


    $status = "confirmed";


    $query = "

    UPDATE appointments

    SET

    beautician_id = ?,

    status = ?

    WHERE id = ?

    ";



    $stmt =
        mysqli_prepare(
            $this->conn,
            $query
        );



    mysqli_stmt_bind_param(
        $stmt,
        "isi",
        $beauticianId,
        $status,
        $appointmentId
    );



    return mysqli_stmt_execute($stmt);


}









    /*
    ==================================
    DELETE APPOINTMENT
    ==================================
    */


    public function deleteAppointment($id)
    {


        $query = "

        DELETE FROM appointments

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









    /*
    ==================================
    GET CUSTOMERS
    ==================================
    */


    public function getCustomers()
    {


        $query = "

        SELECT id, full_name

        FROM users

        WHERE role = 'customer'

        ORDER BY full_name ASC

        ";



        $result =
            mysqli_query(
                $this->conn,
                $query
            );



        $customers = [];



        while($row = mysqli_fetch_assoc($result))
        {

            $customers[] = $row;

        }



        return $customers;


    }









    /*
    ==================================
    GET BEAUTICIANS
    ==================================
    */


    public function getBeauticians()
    {


        $query = "

        SELECT id, full_name

        FROM users

        WHERE role = 'beautician'

        ORDER BY full_name ASC

        ";



        $result =
            mysqli_query(
                $this->conn,
                $query
            );



        $beauticians = [];



        while($row = mysqli_fetch_assoc($result))
        {

            $beauticians[] = $row;

        }



        return $beauticians;


    }

    /*
==================================
GET CONFIRMED APPOINTMENTS
FOR BEAUTICIAN
==================================
*/


public function getConfirmedAppointmentsForBeautician($beauticianId)
{


    $query = "

    SELECT

    appointments.*,

    customer.full_name AS customer_name,

    services.service_name


    FROM appointments



    LEFT JOIN users customer

    ON appointments.customer_id = customer.id



    LEFT JOIN services

    ON appointments.service_id = services.id



    WHERE

    appointments.beautician_id = ?

    AND

    appointments.status = 'confirmed'



    ORDER BY appointments.id DESC


    ";



    $stmt =
        mysqli_prepare(
            $this->conn,
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



    $appointments = [];



    while($row = mysqli_fetch_assoc($result))
    {

        $appointments[] = $row;

    }



    return $appointments;


}








    /*
    ==================================
    GET SERVICES
    ==================================
    */


    public function getServices()
    {


        $query = "

        SELECT id, service_name

        FROM services

        ORDER BY service_name ASC

        ";



        $result =
            mysqli_query(
                $this->conn,
                $query
            );



        $services = [];



        while($row = mysqli_fetch_assoc($result))
        {

            $services[] = $row;

        }



        return $services;


    }



}

?>