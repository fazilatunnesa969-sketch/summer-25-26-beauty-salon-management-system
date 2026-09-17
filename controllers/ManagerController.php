<?php


require_once __DIR__ . '/../models/Manager.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../config/database.php';




/*
==================================
MANAGER DASHBOARD
==================================
*/

function managerDashboard()
{

    global $conn;


    $totalEmployees =
        getTotalEmployees($conn);



    $totalCustomers = 0;



    require __DIR__
    . '/../views/dashboard/index.php';

}






/*
==================================
REVENUE ANALYTICS
==================================
*/

function revenueReport()
{

    global $conn;


    $totalRevenue =
        getTotalRevenue($conn);



    $monthlyRevenue =
        getMonthlyRevenue($conn);



    $totalBookings =
        getTotalBookings($conn);



    require __DIR__
    . '/../views/manager/revenue-report.php';

}







/*
==================================
EMPLOYEE PERFORMANCE
==================================
*/

function employeeRanking()
{

    global $conn;


    $ranking =
        getEmployeeRanking($conn);



    require __DIR__
    . '/../views/manager/employee-ranking.php';

}






/*
==================================
PEAK HOUR ANALYSIS
==================================
*/

function peakHourAnalysis()
{

    global $conn;


    $peakHours =
        getPeakHourAnalysis($conn);



    require __DIR__
    . '/../views/manager/peak-hour-analysis.php';

}






/*
==================================
USERS
==================================
*/

function managerUsers()
{

    global $conn;


    $staff =
        getAllEmployees($conn);



    require __DIR__
    . '/../views/manager/users.php';

}






/*
==================================
ADD STAFF
==================================
*/

function addStaff()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        createEmployee(

            $conn,

            $_POST['full_name'],

            $_POST['email'],

            $_POST['username'],

            $_POST['password'],

            $_POST['role']

        );



        header(
            "Location: index.php?page=manager-users"
        );


        exit;

    }



    require __DIR__
    . '/../views/manager/add-staff.php';

}






/*
==================================
EDIT STAFF
==================================
*/

function editStaff()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    $staff =
        getEmployeeById(
            $conn,
            $id
        );



    require __DIR__
    . '/../views/manager/edit-staff.php';

}






/*
==================================
UPDATE STAFF
==================================
*/







/*
==================================
DELETE STAFF
==================================
*/

function deleteStaff()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    if($id)
    {

        deleteEmployeeData(
            $conn,
            $id
        );

    }



    header(
        "Location: index.php?page=manager-users"
    );


    exit;

}



/*
==================================
SERVICES
==================================
*/

function managerServices()
{

    global $conn;


    $services =
        getAllServices($conn);



    require __DIR__
    . '/../views/manager/services.php';

}






/*
==================================
EMPLOYEE MANAGEMENT
==================================
*/

function employees()
{

    global $conn;



    if(!empty($_GET['search']))
    {


        $employees =
            searchEmployees(

                $conn,

                $_GET['search']

            );


    }
    else
    {


        $employees =
            getAllEmployees($conn);


    }



    require __DIR__
    . '/../views/manager/employees.php';

}






/*
==================================
ADD EMPLOYEE
==================================
*/

function addEmployee()
{

    global $conn;


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        createEmployee(

            $conn,

            $_POST['full_name'],

            $_POST['email'],

            $_POST['username'],

            $_POST['password'],

            $_POST['role']

        );



        header(
            "Location: index.php?page=manager-employees"
        );


        exit;

    }



    require __DIR__
    . '/../views/manager/add-employee.php';

}






/*
==================================
EDIT EMPLOYEE
==================================
*/

function editEmployee()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    $employee =
        getEmployeeById(

            $conn,

            $id

        );



    require __DIR__
    . '/../views/manager/edit-employee.php';

}






/*
==================================
UPDATE EMPLOYEE
==================================
*/

function updateEmployee()
{

    global $conn;



    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        updateEmployeeData(

            $conn,

            $_POST['id'],

            $_POST['full_name'],

            $_POST['email'],

            $_POST['username'],

            $_POST['role'],

            $_POST['status']

        );



        header(
            "Location: index.php?page=manager-employees"
        );


        exit;

    }

}






/*
==================================
DELETE EMPLOYEE
==================================
*/

function deleteEmployee()
{

    global $conn;


    $id =
        $_GET['id'] ?? null;



    if($id)
    {


        deleteEmployeeData(

            $conn,

            $id

        );


    }



    header(
        "Location: index.php?page=manager-employees"
    );


    exit;

}







/*
==================================
AJAX EMPLOYEE SEARCH
==================================
*/

function searchEmployee()
{

    global $conn;



    $keyword =
        $_GET['keyword'] ?? '';



    $sql = "

    SELECT

    id,
    full_name,
    email

    FROM users


    WHERE

    full_name LIKE ?

    OR email LIKE ?


    LIMIT 10

    ";




    $stmt =
        mysqli_prepare(

            $conn,

            $sql

        );



    $search =
        "%".$keyword."%";



    mysqli_stmt_bind_param(

        $stmt,

        "ss",

        $search,

        $search

    );



    mysqli_stmt_execute($stmt);



    $result =
        mysqli_stmt_get_result($stmt);



    $employees = [];



    while($row =
        mysqli_fetch_assoc($result))
    {

        $employees[] = $row;

    }



    require __DIR__
    . '/../views/manager/employee-table.php';


    exit;

}

