<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


/*
=========================================
LOAD CONFIG + HELPERS + CONTROLLERS
=========================================
*/

require_once __DIR__ . '/config/database.php';

require_once __DIR__ . '/helpers/auth.php';


require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';

require_once __DIR__ . '/controllers/ManagerController.php';
require_once __DIR__ . '/controllers/ReceptionistController.php';
require_once __DIR__ . '/controllers/BeauticianController.php';
require_once __DIR__ . '/controllers/CustomerController.php';



$page = $_GET['page'] ?? 'home';



/*
=========================================
ROUTES
=========================================
*/


switch($page)
{


/* HOME */

case 'home':

    home();

break;



/* AUTH */

case 'signup':

    signup();

break;



case 'login':

    login();

break;



case 'logout':

    logoutUser();

    header(
        "Location:index.php?page=login"
    );

    exit;

break;





/* DASHBOARD */

case 'dashboard':

    require __DIR__
    . '/views/dashboard/index.php';

break;







case 'manager-dashboard':

    managerDashboard();

break;
case 'search-employee':

    searchEmployee();

break;


case 'manager-employees':

    employees();

break;


case 'add-employee':

    addEmployee();

break;


case 'edit-employee':

    editEmployee();

break;


case 'update-employee':

    updateEmployee();

break;


case 'delete-employee':

    deleteEmployee();

break;


case 'revenue-report':

    revenueReport();

break;


case 'employee-ranking':

    employeeRanking();

break;


case 'peak-hour-analysis':

    peakHourAnalysis();

break;


case 'manager-users':

    managerUsers();

break;


case 'manager-services':

    managerServices();

break;



/* RECEPTIONIST */


case 'receptionist-dashboard':

    receptionistDashboard();

break;

case 'search-appointments-ajax':

    searchAppointmentsAjax();

break;


case 'appointment-queue':

    appointmentQueue();

break;


case 'add-appointment':

    addAppointment();

break;
case 'save-receptionist-appointment':

    saveReceptionistAppointment();

break;


case 'assign-beautician':

    assignBeautician();

break;


case 'delete-appointment':

    deleteAppointment();

break;


case 'update-appointment-status':

    updateAppointmentStatus();

break;




case 'notices':

    notices();

break;


case 'add-notice':

    addNotice();

break;


case 'delete-notice':

    deleteNotice();

break;




case 'invoices':

    invoices();

break;


case 'add-invoice':

    addInvoice();

break;


case 'update-payment':

    updatePayment();

break;


case 'delete-invoice':

    deleteInvoice();

break;






/* BEAUTICIAN */


case 'beautician-dashboard':

    beauticianDashboard();

break;


case 'service-timer':

    serviceTimer();

break;


case 'start-service':

    startService();

break;


case 'complete-service':

    completeService();

break;


case 'safety-alert':

    safetyAlert();

break;


case 'delete-alert':

    deleteAlert();

break;


case 'follow-up':

    followUp();

break;


case 'add-follow-up':

    addFollowUp();

break;


case 'delete-follow-up':

    deleteFollowUp();

break;






/* CUSTOMER */


case 'customer-dashboard':

    customerDashboard();

break;


case 'book-appointment':

    bookAppointment();

break;


case 'save-appointment':

    saveAppointment();

break;


case 'profile':

    profile();

break;


case 'payment':

    require __DIR__
    . '/views/customer/payment.php';

break;


case 'save-payment':

    savePayment();

break;


case 'my-appointments':

    myAppointments();

break;


case 'search-appointments':

    customerSearchAppointments();

break;


case 'my-payments':

    myPayments();

break;


case 'cancel-appointment':

    cancelAppointment();

break;


case 'reschedule-appointment':

    rescheduleAppointment();

break;




default:


    http_response_code(404);


    echo "
    <h1>404</h1>
    <p>Page not found</p>
    ";


break;


}

?>
