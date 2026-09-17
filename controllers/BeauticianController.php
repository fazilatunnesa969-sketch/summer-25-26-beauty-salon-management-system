<?php


require_once __DIR__ . '/../models/ServiceTimer.php';
require_once __DIR__ . '/../models/SafetyAlert.php';
require_once __DIR__ . '/../models/FollowUp.php';
require_once __DIR__ . '/../models/Notice.php';
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../config/database.php';





/*
==================================
SERVICE TIMER PAGE
==================================
*/

function serviceTimer()
{

    global $conn;



    $beauticianId =
        $_SESSION['user_id'];



    $services =
        getRunningServices(
            $conn,
            $beauticianId
        );



    $appointments =
        getConfirmedAppointmentsForBeautician(
            $conn,
            $beauticianId
        );



    require __DIR__
    . '/../views/beautician/service-timer.php';


}








/*
==================================
START SERVICE
==================================
*/

function startService()
{

    global $conn;



    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $beautician =
            $_SESSION['user_id'];



        $appointmentId =
            $_POST['appointment_id'];



        $customer =
            $_POST['customer_id'];



        $service =
            $_POST['service_name'];







        startServiceTimer(
            $conn,
            $beautician,
            $customer,
            $service
        );






        updateStatus(
            $conn,
            $appointmentId,
            "in_service"
        );







        header(
            "Location:index.php?page=service-timer"
        );


        exit;


    }


}








/*
==================================
COMPLETE SERVICE
==================================
*/

function completeService()
{

    global $conn;



    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        completeServiceTimer(
            $conn,
            $id
        );


    }



    header(
        "Location:index.php?page=service-timer"
    );


    exit;


}
/*
==================================
SAFETY ALERT
==================================
*/

function safetyAlert()
{

    global $conn;


    $alerts =
        getAllAlerts($conn);



    require __DIR__
    . '/../views/beautician/safety-alert.php';


}








/*
==================================
DELETE ALERT
==================================
*/

function deleteAlert()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        deleteAlertData(
            $conn,
            $id
        );


    }



    header(
        "Location:index.php?page=safety-alert"
    );


    exit;


}








/*
==================================
FOLLOW UP PAGE
==================================
*/

function followUp()
{

    global $conn;



    $followUps =
        getAllFollowUps($conn);



    require __DIR__
    . '/../views/beautician/follow-up.php';


}








/*
==================================
ADD FOLLOW UP
==================================
*/

function addFollowUp()
{

    global $conn;



    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $customer =
            $_POST['customer_id'];



        $service =
            $_POST['service_name'];



        $date =
            $_POST['follow_up_date'];



        $note =
            $_POST['note'];





        createFollowUp(
            $conn,
            $customer,
            $service,
            $date,
            $note
        );






        header(
            "Location:index.php?page=follow-up"
        );


        exit;


    }



    require __DIR__
    . '/../views/beautician/add-follow-up.php';


}








/*
==================================
DELETE FOLLOW UP
==================================
*/

function deleteFollowUp()
{

    global $conn;



    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        deleteFollowUpData(
            $conn,
            $id
        );


    }



    header(
        "Location:index.php?page=follow-up"
    );


    exit;


}/*
==================================
BEAUTICIAN DASHBOARD
==================================
*/

function beauticianDashboard()
{

    global $conn;



    $beauticianNotices =
        getBeauticianNotices(
            $conn
        );



    require __DIR__
    . '/../views/dashboard/index.php';


}


?>