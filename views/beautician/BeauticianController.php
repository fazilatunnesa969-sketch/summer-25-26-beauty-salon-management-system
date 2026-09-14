<?php


require_once __DIR__ . '/../models/ServiceTimer.php';
require_once __DIR__ . '/../models/SafetyAlert.php';
require_once __DIR__ . '/../models/FollowUp.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Notice.php';
require_once __DIR__ . '/../models/Appointment.php';


class BeauticianController
{


    private $timerModel;

    private $alertModel;

    private $followUpModel;
    private $noticeModel;
    private $appointmentModel;





    public function __construct()
    {


        global $conn;



        $this->timerModel =
            new ServiceTimer($conn);



        $this->alertModel =
            new SafetyAlert($conn);



        $this->followUpModel =
            new FollowUp($conn);

            $this->noticeModel =
            new Notice($conn);   
            $this->appointmentModel =
            new Appointment($conn);

    }







/*
==================================
SERVICE TIMER PAGE
==================================
*/


public function serviceTimer()
{


    $beauticianId =
        $_SESSION['user_id'];
    
    
    
    $services =
        $this->timerModel
        ->getRunningServices(
            $beauticianId
        );


    $appointments =
        $this->appointmentModel
        ->getConfirmedAppointmentsForBeautician(
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

public function startService()
{


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





        // CREATE TIMER

        $this->timerModel
        ->startService(

            $beautician,

            $customer,

            $service

        );





        // UPDATE APPOINTMENT STATUS

        $this->appointmentModel
        ->updateStatus(

            $appointmentId,

            "in_service"

        );





        header(
            "Location: index.php?page=service-timer"
        );


        exit;


    }


}


/*
==================================
COMPLETE SERVICE
==================================
*/


public function completeService()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        $this->timerModel
        ->completeService($id);


    }



    header(
        "Location: index.php?page=service-timer"
    );


    exit;


}


/*
==================================
SAFETY ALERT
==================================
*/

public function safetyAlert()
{


    $alerts =
        $this->alertModel
        ->getAllAlerts();



    require __DIR__
    . '/../views/beautician/safety-alert.php';


}








/*
==================================
DELETE ALERT
==================================
*/


public function deleteAlert()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        $this->alertModel
        ->deleteAlert($id);


    }



    header(
        "Location: index.php?page=safety-alert"
    );


    exit;


}









/*
==================================
FOLLOW UP PAGE
==================================
*/


public function followUp()
{


    $followUps =
        $this->followUpModel
        ->getAllFollowUps();



    require __DIR__
    . '/../views/beautician/follow-up.php';


}








/*
==================================
ADD FOLLOW UP
==================================
*/


public function addFollowUp()
{


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




        $this->followUpModel
        ->createFollowUp(

            $customer,

            $service,

            $date,

            $note

        );




        header(
            "Location: index.php?page=follow-up"
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


public function deleteFollowUp()
{


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        $this->followUpModel
        ->deleteFollowUp($id);


    }



    header(
        "Location: index.php?page=follow-up"
    );


    exit;


}
/*
==================================
BEAUTICIAN DASHBOARD
==================================
*/


public function dashboard()
{
    
   

    $beauticianNotices =

        $this->noticeModel
        ->getBeauticianNotices();

       

       



    require __DIR__
    . '/../views/dashboard/index.php';


}



}

?>