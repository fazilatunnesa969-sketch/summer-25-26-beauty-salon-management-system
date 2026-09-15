<?php


require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Invoice.php';
require_once __DIR__ . '/../models/Notice.php';
require_once __DIR__ . '/../config/database.php';




/*
==================================
APPOINTMENT QUEUE
==================================
*/

function appointmentQueue()
{

    global $conn;


    if(
        isset($_GET['search'])
        &&
        $_GET['search'] != ''
    )
    {


        $appointments =
            searchAppointments(
                $conn,
                $_GET['search']
            );


    }
    else
    {


        $appointments =
            getAllAppointments($conn);


    }



    $beauticians =
        getBeauticians($conn);



    require __DIR__
    . '/../views/receptionist/appointment-queue.php';


}
/*
==================================
ADD APPOINTMENT PAGE
==================================
*/

function addAppointment()
{

    global $conn;


    $customers =
        getCustomers($conn);


    $services =
        getServices($conn);



    require __DIR__
    . '/../views/receptionist/add-appointment.php';

}
/*
==================================
SAVE RECEPTIONIST APPOINTMENT
==================================
*/

function saveReceptionistAppointment()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $customer =
            $_POST['customer_id'];


        $service =
            $_POST['service_id'];


        $date =
            $_POST['appointment_date'];


        $time =
            $_POST['appointment_time'];



        createAppointment(
            $conn,
            $customer,
            $service,
            $date,
            $time,
            ''
        );



        header(
            "Location: index.php?page=appointment-queue"
        );


        exit;

    }

}






/*
==================================
SEARCH APPOINTMENTS AJAX
==================================
*/

function searchAppointmentsAjax()
{

    global $conn;


    $keyword =
        $_GET['search'] ?? '';



    $appointments =
        searchAppointments(
            $conn,
            $keyword
        );



    header(
        'Content-Type: application/json'
    );



    echo json_encode($appointments);


    exit;

}






/*
==================================
DELETE APPOINTMENT
==================================
*/

function deleteAppointment()
{

    global $conn;


    deleteAppointmentData(
        $conn,
        $id
    );



    header(
        "Location: index.php?page=appointment-queue"
    );


    exit;

}



/*
==================================
INVOICE LIST
==================================
*/

function invoices()
{

    global $conn;


    if(
        isset($_GET['search'])
        &&
        $_GET['search'] != ''
    )
    {


        $invoices =
            searchInvoice(
                $conn,
                $_GET['search']
            );


    }
    else
    {


        $invoices =
            getAllInvoices($conn);


    }



    require __DIR__
    . '/../views/receptionist/invoices.php';


}








/*
==================================
ADD INVOICE
==================================
*/

function addInvoice()
{

    global $conn;


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



        createInvoice(
            $conn,
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

function updatePayment()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;


    $status =
        $_GET['status'] ?? null;



    if($id && $status)
    {


        updatePaymentStatus(
            $conn,
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

function deleteInvoice()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        deleteInvoiceData(
            $conn,
            $id
        );


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

function notices()
{

    global $conn;


    $notices =
        getAllNotices($conn);



    require __DIR__
    . '/../views/receptionist/notices.php';


}








/*
==================================
ADD NOTICE
==================================
*/

function addNotice()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $title =
            $_POST['title'] ?? '';



        $message =
            $_POST['message'] ?? '';



        $receiverRole =
            $_POST['receiver_role']
            ??
            'beautician';



        $createdBy =
            $_SESSION['user_id']
            ??
            0;



        createNotice(
            $conn,
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

function deleteNotice()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        deleteNoticeData(
            $conn,
            $id
        );


    }



    header(
        "Location: index.php?page=notices"
    );


    exit;

}
/*
==================================
RECEPTIONIST DASHBOARD
==================================
*/

function receptionistDashboard()
{

    require __DIR__
    . '/../views/dashboard/index.php';

}

/*
==================================
ASSIGN BEAUTICIAN
==================================
*/

function assignBeautician()
{

    global $conn;


    $appointmentId =
        $_POST['appointment_id'] ?? null;


    $beauticianId =
        $_POST['beautician_id'] ?? null;



    if($appointmentId && $beauticianId)
    {

        assignBeauticianData(
            $conn,
            $appointmentId,
            $beauticianId
        );

    }



    header(
        "Location: index.php?page=appointment-queue"
    );


    exit;

}

?>
