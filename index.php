<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();



/* =========================================
   CONTROLLERS LOAD
========================================= */


require_once __DIR__ . '/controllers/HomeController.php';

require_once __DIR__ . '/controllers/AuthController.php';

require_once __DIR__ . '/controllers/ManagerController.php';
require_once __DIR__ . '/controllers/ReceptionistController.php';
require_once __DIR__ . '/controllers/BeauticianController.php';
require_once __DIR__ . '/controllers/CustomerController.php';


require_once __DIR__ . '/helpers/auth.php';





$page = $_GET['page'] ?? 'home';







/* =========================================
   CONTROLLER OBJECTS
========================================= */


$homeController = new HomeController();


$authController = new AuthController();


$managerController = new ManagerController();

$receptionistController = new ReceptionistController();

$beauticianController = new BeauticianController();

$customerController = new CustomerController();







/* =========================================
   ROUTES
========================================= */


switch ($page) {




/* =========================
   HOME
========================= */


case 'home':


    $homeController->index();


break;





/* =========================
   SIGNUP
========================= */


case 'signup':


    $authController->signup();


break;





/* =========================
   LOGIN
========================= */


case 'login':


    $authController->login();


break;
/* =========================
   DASHBOARD
========================= */


case 'dashboard':


    require __DIR__
    . '/views/dashboard/index.php';


break;







/* =========================
   MANAGER
========================= */


case 'manager-dashboard':


    $managerController->dashboard();


break;




case 'manager-employees':


    $managerController->employees();


break;




case 'add-employee':


    $managerController->addEmployee();


break;




case 'edit-employee':


    $managerController->editEmployee();


break;




case 'update-employee':


    $managerController->updateEmployee();


break;




case 'delete-employee':


    $managerController->deleteEmployee();


break;




case 'revenue-report':


    $managerController->revenueReport();


break;




case 'employee-ranking':


    $managerController->employeeRanking();


break;




case 'peak-hour-analysis':


    $managerController->peakHourAnalysis();


break;




case 'manager-users':


    $managerController->users();


break;




case 'manager-services':


    $managerController->services();


break;




case 'add-staff':


    $managerController->addStaff();


break;




case 'edit-staff':


    $managerController->editStaff();


break;




case 'update-staff':


    $managerController->updateStaff();


break;




case 'delete-staff':


    $managerController->deleteStaff();


break;




case 'search-employee':


    $managerController->searchEmployee();


break;









/* =========================
   BEAUTICIAN
========================= */







case 'service-timer':


    $beauticianController->serviceTimer();


break;




case 'start-service':


    $beauticianController->startService();


break;




case 'start-service-form':


    require __DIR__
    . '/views/beautician/start-service.php';


break;




case 'complete-service':


    $beauticianController->completeService();


break;




case 'safety-alert':


    $beauticianController->safetyAlert();


break;




case 'delete-alert':


    $beauticianController->deleteAlert();


break;




case 'follow-up':


    $beauticianController->followUp();


break;




case 'add-follow-up':


    $beauticianController->addFollowUp();


break;




case 'delete-follow-up':


    $beauticianController->deleteFollowUp();


break;
/* =========================
   RECEPTIONIST
========================= */



case 'receptionist-dashboard':

    require __DIR__
    . '/views/dashboard/index.php';

break;


case 'search-appointments-ajax':

    $receptionistController->searchAppointmentsAjax();

break;

case 'assign-beautician':

    $receptionistController
    ->assignBeautician();

break;

case 'appointment-queue':

    $receptionistController->appointmentQueue();

break;




case 'delete-appointment':


    $receptionistController->deleteAppointment();


break;





case 'add-appointment':


    $receptionistController->addAppointment();


break;





case 'update-appointment-status':


    $receptionistController
    ->updateAppointmentStatus();


break;





/* =========================
   NOTICE
========================= */


case 'notices':


    $receptionistController->notices();


break;




case 'add-notice':


    $receptionistController->addNotice();


break;




case 'delete-notice':


    $receptionistController->deleteNotice();


break;







/* =========================
   INVOICE
========================= */


case 'invoices':


    $receptionistController->invoices();


break;




case 'add-invoice':


    $receptionistController->addInvoice();


break;




case 'update-payment':


    $receptionistController->updatePayment();


break;




case 'delete-invoice':


    $receptionistController->deleteInvoice();


break;








/* =========================
   LOGOUT
========================= */


case 'logout':


    logoutUser();



    header(
        "Location:index.php?page=login"
    );


    exit;








/* =========================
   CUSTOMER
========================= */


case 'book-appointment':


    $customerController->bookAppointment();


break;

case 'profile':

    $customerController
    ->profile();

    break;




case 'save-appointment':


    $customerController->saveAppointment();


break;




case 'payment':


    require __DIR__
    . '/views/customer/payment.php';


break;




case 'save-payment':


    $customerController->savePayment();


break;




case 'customer-dashboard':


    $customerController->dashboard();


break;




case 'my-appointments':


    $customerController->myAppointments();


break;

case 'search-appointments':

    $customerController
    ->searchAppointments();

break;



case 'my-payments':


    $customerController->myPayments();


break;

case 'cancel-appointment':

   

    $customerController
    ->cancelAppointment();

break;

case 'reschedule-appointment':

    $customerController
    ->rescheduleAppointment();

break;

case 'beautician-dashboard':

    $beauticianController
    ->dashboard();

break;
/* =========================
   404
========================= */


default:


    http_response_code(404);



    echo "

    <h1>404</h1>

    <p>Page not found.</p>

    ";


break;



}



?>