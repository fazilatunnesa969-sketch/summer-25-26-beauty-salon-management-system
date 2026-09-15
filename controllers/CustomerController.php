<?php


require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Invoice.php';
require_once __DIR__ . '/../models/SafetyAlert.php';
require_once __DIR__ . '/../config/database.php';




/*
==================================
BOOK APPOINTMENT PAGE
==================================
*/

function bookAppointment()
{

    global $conn;


    $services =
    getCustomerServices($conn);


    $customer = [];



    if(isset($_SESSION['user_id']))
    {


        $customerId =
            $_SESSION['user_id'];



        $customer =
            getCustomerInfo(
                $conn,
                $customerId
            );


    }



    require __DIR__
    . '/../views/customer/book-appointment.php';


}








/*
==================================
CUSTOMER DASHBOARD
==================================
*/

function customerDashboard()
{

    global $conn;


    $customerId =
        $_SESSION['user_id'];



    $appointments =
        getAppointments(
            $conn,
            $customerId
        );



    $nextVisit =
        getNextRecommendedVisit(
            $conn,
            $customerId
        );



    require __DIR__
    . '/../views/dashboard/index.php';


}








/*
==================================
MY APPOINTMENTS
==================================
*/

function myAppointments()
{

    global $conn;


    if(!isset($_SESSION['user_id']))
    {

        echo json_encode([
            "status"=>"error",
            "message"=>"Session expired"
        ]);

        exit;

    }



    $customerId =
        $_SESSION['user_id'];



    $appointments =
        getUpcomingAppointments(
            $conn,
            $customerId
        );



    require __DIR__
    . '/../views/customer/my-appointments.php';


}








/*
==================================
SEARCH APPOINTMENTS AJAX
==================================
*/

function customerSearchAppointments()
{

    global $conn;


    if(!isset($_SESSION['user_id']))
    {


        echo json_encode([]);


        exit;


    }



    $customerId =
        $_SESSION['user_id'];



    $keyword =
        $_GET['keyword'] ?? '';




    $appointments =
        searchAppointments(
            $conn,
            $customerId,
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
CANCEL APPOINTMENT AJAX
==================================
*/

function cancelAppointment()
{

    global $conn;


    header(
        'Content-Type: application/json'
    );



    if(!isset($_SESSION['user_id']))
    {


        echo json_encode([

            "status"=>"error",

            "message"=>"Unauthorized"

        ]);


        exit;


    }




    $customerId =
        $_SESSION['user_id'];



    $appointmentId =
        $_POST['appointment_id']
        ?? null;



    if(!$appointmentId)
    {


        echo json_encode([

            "status"=>"error",

            "message"=>"Invalid appointment"

        ]);


        exit;


    }



    $result =
        cancelCustomerAppointment(
            $conn,
            $appointmentId,
            $customerId
        );



    echo json_encode([

        "status" =>
        $result ? "success" : "error"

    ]);



    exit;


}








/*
==================================
RESCHEDULE APPOINTMENT
==================================
*/

function rescheduleAppointment()
{

    global $conn;


    header(
        'Content-Type: application/json'
    );



    if(!isset($_SESSION['user_id']))
    {


        echo json_encode([

            "status"=>"error",

            "message"=>"Session expired"

        ]);



        exit;


    }




    $customerId =
        $_SESSION['user_id'];



    $id =
        $_POST['appointment_id'];



    $date =
        $_POST['appointment_date'];



    $time =
        $_POST['appointment_time'];





    $result =
        rescheduleAppointment(
            $conn,
            $id,
            $customerId,
            $date,
            $time
        );





    echo json_encode([

        "status" =>
        $result ? "success" : "error"

    ]);



    exit;


}








/*
==================================
SAVE APPOINTMENT
==================================
*/

function saveAppointment()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD']=="POST")
    {


        $service =
            $_POST['service_id'];



        $date =
            $_POST['appointment_date'];



        $time =
            $_POST['appointment_time'];



        $safetyNote =
            $_POST['safety_note']
            ?? '';







        /*
        ==========================
        CHECK CUSTOMER LOGIN
        ==========================
        */


        if(isset($_SESSION['user_id']))
        {


            $customerId =
                $_SESSION['user_id'];


        }
        else
        {


            $fullName =
                $_POST['full_name'];



            $email =
                $_POST['email'];



            $phone =
                $_POST['phone'];



            $password =
                $_POST['password'];





            $customerId =
                createCustomer(
                    $conn,
                    $fullName,
                    $email,
                    $phone,
                    $password
                );





            $_SESSION['user_id'] =
                $customerId;



            $_SESSION['role'] =
                "customer";



            $_SESSION['full_name'] =
                $fullName;



            $_SESSION['email'] =
                $email;


        }







        /*
        ==========================
        GET SERVICE DATA
        ==========================
        */


        $serviceData =
            getServiceById(
                $conn,
                $service
            );



        if(!$serviceData)
        {

            die("Service not found");

        }







        /*
        ==========================
        CREATE APPOINTMENT
        ==========================
        */


        $appointmentId =
            createAppointment(
                $conn,
                $customerId,
                $service,
                $date,
                $time,
                $safetyNote
            );






        /*
        ==========================
        CREATE INVOICE
        ==========================
        */


        createInvoice(
            $conn,
            $appointmentId,
            $customerId,
            $serviceData['price'],
            "Not Selected"
        );






        header(
            "Location:index.php?page=customer-dashboard"
        );


        exit;


    }


}
/*
==================================
MY PAYMENTS
==================================
*/

function myPayments()
{

    global $conn;


    $customerId =
        $_SESSION['user_id'];



    /*
    NOTE:
    তোমার Customer model-এ getPayments()
    function আগে ছিল না।
    তাই যদি payment page কাজ না করে,
    আলাদা payment model/function লাগবে।
    */



    $payments = [];



    require __DIR__
    . '/../views/customer/my-payments.php';


}








/*
==================================
SAVE PAYMENT
==================================
*/

function savePayment()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD']=="POST")
    {


        $customerId =
            $_SESSION['user_id'];



        $amount =
            $_SESSION['service_price']
            ?? 0;



        $paymentMethod =
            $_POST['payment_method'];



        $transactionId =
            $_POST['transaction_id'];







        /*
        ==========================
        GET LAST APPOINTMENT
        ==========================
        */


        $appointment =
            getLastAppointment(
                $conn,
                $customerId
            );





        if($appointment)
        {


            $appointmentId =
                $appointment['id'];







            /*
            ==========================
            SAVE PAYMENT
            ==========================
            */


            createPayment(
                $conn,
                $customerId,
                $appointmentId,
                $amount,
                $paymentMethod,
                $transactionId
            );








            /*
            ==========================
            UPDATE PAYMENT STATUS
            ==========================
            */


            updateCustomerPaymentStatus(
                $conn,
                $appointmentId
            );







            /*
            ==========================
            CREATE SAFETY ALERT
            ==========================
            */


            createSafetyAlert(
                $conn,
                $appointmentId
            );


        }







        header(
            "Location:index.php?page=customer-dashboard"
        );



        exit;



    }


}
/*
==================================
MY PROFILE
==================================
*/

function profile()
{

    global $conn;



    if(!isset($_SESSION['user_id']))
    {


        header(
            "Location:index.php?page=login"
        );


        exit;


    }





    $customerId =
        $_SESSION['user_id'];






    $profile =
        getProfile(
            $conn,
            $customerId
        );




    $appointmentHistory =
        getProfileHistory(
            $conn,
            $customerId
        );







    require __DIR__

    . '/../views/customer/profile.php';



}

?>
