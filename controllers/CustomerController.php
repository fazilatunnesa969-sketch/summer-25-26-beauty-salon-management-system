<?php


require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/SafetyAlert.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Invoice.php';



class CustomerController
{


    private $customerModel;

    private $alertModel;
    private $invoiceModel;



    public function __construct()
    {

        global $conn;


        $this->customerModel =
            new Customer($conn);


        $this->alertModel =
            new SafetyAlert($conn);

        $this->invoiceModel =
            new Invoice($conn);

    }






/*
==================================
BOOK APPOINTMENT PAGE
==================================
*/


public function bookAppointment()
{


    $services =
        $this->customerModel
        ->getServices();



    $customer = [];



    if(isset($_SESSION['user_id']))
    {


        $customerId =
            $_SESSION['user_id'];



        $customer =
            $this->customerModel
            ->getCustomerInfo($customerId);


    }




    require __DIR__
    . '/../views/customer/book-appointment.php';



}









/*
==================================
CUSTOMER DASHBOARD
==================================
*/


public function dashboard()
{


    $customerId =
        $_SESSION['user_id'];



    $appointments =
        $this->customerModel
        ->getAppointments($customerId);

     $nextVisit =
        $this->customerModel
        ->getNextRecommendedVisit($customerId);
        
            



    require __DIR__
    . '/../views/dashboard/index.php';



}









/*
==================================
MY APPOINTMENTS
==================================
*/


public function myAppointments()
{
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

$this->customerModel
->getUpcomingAppointments($customerId);



require __DIR__
. '/../views/customer/my-appointments.php';



}
/*
==================================
SEARCH APPOINTMENTS AJAX
==================================
*/


public function searchAppointments()
{


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

$this->customerModel
->searchAppointments(

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


public function cancelAppointment()
{





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
$_POST['appointment_id'] ?? null;




if(!$appointmentId)
{


echo json_encode([
"status"=>"error",
"message"=>"Invalid appointment"
]);


exit;


}





$result =

$this->customerModel
->cancelAppointment(

$appointmentId,

$customerId

);





echo json_encode([

"status" => $result ? "success" : "error"

]);



exit;



}

public function rescheduleAppointment()
{


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
$this->customerModel
->rescheduleAppointment(

$id,

$customerId,

$date,

$time

);




echo json_encode([

"status" =>
$result ? "success":"error"

]);


exit;


}









/*
==================================
MY PAYMENTS
==================================
*/


public function myPayments()
{


    $customerId =
        $_SESSION['user_id'];



    $payments =
        $this->customerModel
        ->getPayments($customerId);



    require __DIR__
    . '/../views/customer/my-payments.php';



}








/*
==================================
SAVE APPOINTMENT
==================================
*/


public function saveAppointment()
{


if($_SERVER['REQUEST_METHOD']=="POST")
{


$service =
$_POST['service_id'];



$date =
$_POST['appointment_date'];



$time =
$_POST['appointment_time'];



$safetyNote =
$_POST['safety_note'] ?? '';








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
    $this->customerModel
    ->createCustomer(

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
$this->customerModel
->getServiceById($service);



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
$this->customerModel
->createAppointment(

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


$this->invoiceModel
->createInvoice(

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
SAVE PAYMENT
==================================
*/


public function savePayment()
{


if($_SERVER['REQUEST_METHOD']=="POST")
{


$customerId =
$_SESSION['user_id'];





$amount =
$_SESSION['service_price'];



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

$this->customerModel
->getLastAppointment($customerId);






if($appointment)
{


$appointmentId =
$appointment['id'];







/*
==========================
SAVE PAYMENT
==========================
*/


$this->customerModel
->createPayment(

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


$this->customerModel
->updatePaymentStatus(

    $appointmentId

);







/*
==========================
CREATE SAFETY ALERT
==========================
*/


$this->customerModel
->createSafetyAlert(

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


public function profile()
{


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

$this->customerModel
->getProfile($customerId);

$appointmentHistory =

$this->customerModel
->getProfileHistory($customerId);







require __DIR__

. '/../views/customer/profile.php';



}





}
?>
