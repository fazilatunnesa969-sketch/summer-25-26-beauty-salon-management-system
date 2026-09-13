<?php


require_once __DIR__ . '/SafetyAlert.php';


class Invoice
{


    private $conn;



    public function __construct($conn)
    {

        $this->conn = $conn;

    }





    /*
    ==================================
    CREATE INVOICE
    ==================================
    */


    public function createInvoice(
        $appointment,
        $customer,
        $amount,
        $paymentMethod
    )
    {


        $status = "pending";


        $query = "

        INSERT INTO invoices

        (
            appointment_id,
            customer_id,
            amount,
            payment_method,
            payment_status
        )


        VALUES

        (?,?,?,?,?)

        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );



        mysqli_stmt_bind_param(
            $stmt,
            "iidss",
            $appointment,
            $customer,
            $amount,
            $paymentMethod,
            $status
        );



        return mysqli_stmt_execute($stmt);


    }








    /*
    ==================================
    GET ALL INVOICES
    ==================================
    */


    public function getAllInvoices()
    {


        $query = "

        SELECT

        invoices.*,

        users.full_name AS customer_name


        FROM invoices


        LEFT JOIN users

        ON invoices.customer_id = users.id


        ORDER BY invoices.id DESC


        ";



        $result =
            mysqli_query(
                $this->conn,
                $query
            );



        $invoices = [];



        while($row =
            mysqli_fetch_assoc($result))
        {


            $invoices[] = $row;


        }



        return $invoices;


    }








    /*
    ==================================
    SEARCH INVOICE
    ==================================
    */


    public function searchInvoice($keyword)
    {


        $keyword =
            "%".$keyword."%";



        $query = "

        SELECT

        invoices.*,

        users.full_name AS customer_name


        FROM invoices


        LEFT JOIN users

        ON invoices.customer_id = users.id


        WHERE

        users.full_name LIKE ?


        ORDER BY invoices.id DESC


        ";



        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );



        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $keyword
        );



        mysqli_stmt_execute($stmt);



        $result =
            mysqli_stmt_get_result($stmt);



        $invoices = [];



        while($row =
            mysqli_fetch_assoc($result))
        {


            $invoices[] = $row;


        }



        return $invoices;


    }








    /*
    ==================================
    UPDATE PAYMENT STATUS
    ==================================
    */


    public function updatePaymentStatus(
        $id,
        $status
    )
    {
    
    
        /*
        ==================================
        UPDATE PAYMENT STATUS
        ==================================
        */
    
    
        $query = "
    
        UPDATE invoices
    
        SET payment_status = ?
    
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
    
    
    
        $updated =
            mysqli_stmt_execute($stmt);
    
    
    
        if(!$updated)
        {
    
            return false;
    
        }
    
    
    
    
    
        /*
        ==================================
        CREATE SAFETY ALERT WHEN PAID
        ==================================
        */
    
    
        if($status === 'paid')
        {
    
    
            /*
            GET APPOINTMENT ID
            */
    
    
            $query = "
    
            SELECT appointment_id
    
            FROM invoices
    
            WHERE id = ?
    
            LIMIT 1
    
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
    
    
    
            $invoice =
                mysqli_fetch_assoc($result);
    
    
    
            if(
                $invoice &&
                !empty($invoice['appointment_id'])
            )
            {
    
    
                $appointmentId =
                    $invoice['appointment_id'];
    
    
    
                /*
                CHECK IF ALERT ALREADY EXISTS
                */
    
    
                $checkQuery = "
    
                SELECT id
    
                FROM safety_alerts
    
                WHERE appointment_id = ?
    
                LIMIT 1
    
                ";
    
    
    
                $checkStmt =
                    mysqli_prepare(
                        $this->conn,
                        $checkQuery
                    );
    
    
    
                mysqli_stmt_bind_param(
                    $checkStmt,
                    "i",
                    $appointmentId
                );
    
    
    
                mysqli_stmt_execute(
                    $checkStmt
                );
    
    
    
                $checkResult =
                    mysqli_stmt_get_result(
                        $checkStmt
                    );
    
    
    
                $existingAlert =
                    mysqli_fetch_assoc(
                        $checkResult
                    );
    
    
    
                /*
                CREATE ONLY IF NOT EXISTS
                */
    
    
                if(!$existingAlert)
                {
    
    
                    $safetyAlert =
                        new SafetyAlert(
                            $this->conn
                        );
    
    
    
                    $safetyAlert
                    ->createAlertFromAppointment(
                        $appointmentId
                    );
    
    
                }
    
    
            }
    
    
        }
    
    
    
        return true;
    
    
    }








    /*
    ==================================
    DELETE INVOICE
    ==================================
    */


    public function deleteInvoice($id)
    {


        $query = "

        DELETE FROM invoices

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