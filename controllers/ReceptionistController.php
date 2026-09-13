<?php


require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Invoice.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Notice.php';


class ReceptionistController
{


    private $appointmentModel;
    private $invoiceModel;
    private $noticeModel;



    public function __construct()
    {

        global $conn;


        $this->appointmentModel =
            new Appointment($conn);
            $this->invoiceModel =
    new Invoice($conn);
    $this->noticeModel =
    new Notice($conn);
    }





    /*
    ==================================
    APPOINTMENT QUEUE
    ==================================
    */


    public function appointmentQueue()
{


    if(
        isset($_GET['search']) 
        && 
        $_GET['search'] != ''
    )
    {


        $appointments =
            $this->appointmentModel
            ->searchAppointments(
                $_GET['search']
            );


    }
    else
    {


        $appointments =
            $this->appointmentModel
            ->getAllAppointments();


    }



    $beauticians =
        $this->appointmentModel
        ->getBeauticians();




    require __DIR__
    . '/../views/receptionist/appointment-queue.php';


}
    /*
==================================
SEARCH APPOINTMENTS AJAX
==================================
*/

public function searchAppointmentsAjax()
{


    $keyword =
        $_GET['search'] ?? '';



    $appointments =
        $this->appointmentModel
        ->searchAppointments(
            $keyword
        );



    header(
        'Content-Type: application/json'
    );



    echo json_encode($appointments);


    exit;


}

    public function deleteAppointment()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        $this->appointmentModel
        ->deleteAppointment($id);


    }



    header(
        "Location: index.php?page=appointment-queue"
    );


    exit;


}


public function updateAppointmentStatus()
{


    $id =
        $_GET['id'] ?? null;


    $status =
        $_GET['status'] ?? null;



    if($id && $status)
    {


        $this->appointmentModel
        ->updateStatus(
            $id,
            $status
        );


    }



    header(
        "Location: index.php?page=appointment-queue"
    );


    exit;


}
/*
==================================
ASSIGN BEAUTICIAN
==================================
*/

public function assignBeautician()
{


    $appointmentId =
        $_POST['appointment_id'] ?? null;



    $beauticianId =
        $_POST['beautician_id'] ?? null;



    if($appointmentId && $beauticianId)
    {


        $this->appointmentModel
        ->assignBeautician(

            $appointmentId,

            $beauticianId

        );


    }



    header(
        "Location: index.php?page=appointment-queue"
    );


    exit;


}




public function addAppointment()
{


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $customer =
            $_POST['customer_id'];


        $beautician =
            $_POST['beautician_id'];


        $service =
            $_POST['service_id'];


        $date =
            $_POST['appointment_date'];


        $time =
            $_POST['appointment_time'];



        $this->appointmentModel
        ->createAppointment(

            $customer,

            $beautician,

            $service,

            $date,

            $time

        );



        header(
            "Location: index.php?page=appointment-queue"
        );


        exit;


    }





    // LOAD DROPDOWN DATA


    $customers =
        $this->appointmentModel
        ->getCustomers();



    $beauticians =
        $this->appointmentModel
        ->getBeauticians();



    $services =
        $this->appointmentModel
        ->getServices();






    require __DIR__
    . '/../views/receptionist/add-appointment.php';



}
/*
==================================
INVOICE LIST
==================================
*/


public function invoices()
{


    if(
        isset($_GET['search'])
        &&
        $_GET['search'] != ''
    )
    {


        $invoices =
            $this->invoiceModel
            ->searchInvoice(
                $_GET['search']
            );


    }
    else
    {


        $invoices =
            $this->invoiceModel
            ->getAllInvoices();


    }



    require __DIR__
    . '/../views/receptionist/invoices.php';


}






/*
==================================
ADD INVOICE
==================================
*/


public function addInvoice()
{


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $appointment =
            $_POST['appointment_id'];


        $customer =
            $_POST['customer_id'];


        $amount =
            $_POST['amount'];


        $paymentMethod =
            $_POST['payment_method'];



        $this->invoiceModel
        ->createInvoice(

            $appointment,

            $customer,

            $amount,

            $paymentMethod

        );



        header(
            "Location: index.php?page=invoices"
        );


        exit;


    }



    require __DIR__
    . '/../views/receptionist/add-invoice.php';



}







/*
==================================
UPDATE PAYMENT
==================================
*/


public function updatePayment()
{


    $id =
        $_GET['id'] ?? null;


    $status =
        $_GET['status'] ?? null;



    if($id && $status)
    {


        $this->invoiceModel
        ->updatePaymentStatus(
            $id,
            $status
        );


    }



    header(
        "Location: index.php?page=invoices"
    );


    exit;


}






/*
==================================
DELETE INVOICE
==================================
*/


public function deleteInvoice()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {

        $this->invoiceModel
        ->deleteInvoice($id);

    }



    header(
        "Location: index.php?page=invoices"
    );


    exit;


}
/*
==================================
NOTICE LIST
==================================
*/


public function notices()
{


    $notices =
        $this->noticeModel
        ->getAllNotices();



    require __DIR__
    . '/../views/receptionist/notices.php';


}







/*
==================================
ADD NOTICE
==================================
*/


public function addNotice()
{


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $title =
            $_POST['title'] ?? '';



        $message =
            $_POST['message'] ?? '';



        $receiverRole =
            $_POST['receiver_role'] ?? 'beautician';



        $createdBy =
            $_SESSION['user_id'] ?? 0;




        $this->noticeModel
        ->createNotice(

            $title,

            $message,

            $createdBy,

            $receiverRole

        );




        header(
            "Location: index.php?page=notices"
        );


        exit;


    }



    require __DIR__
    . '/../views/receptionist/add-notice.php';


}
/*
==================================
DELETE NOTICE
==================================
*/


public function deleteNotice()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        $this->noticeModel
        ->deleteNotice($id);


    }



    header(
        "Location: index.php?page=notices"
    );


    exit;


}

}

?>