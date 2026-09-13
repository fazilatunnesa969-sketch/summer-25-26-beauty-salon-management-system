<?php


require_once __DIR__ . '/../models/Manager.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../config/database.php';



class ManagerController
{


    private $managerModel;
    private $serviceModel;



    public function __construct()
    {

        global $conn;


        $this->managerModel =
            new Manager($conn);


        $this->serviceModel =
            new Service($conn);

    }




    /*
    ==================================
        MANAGER DASHBOARD
    ==================================
    */

    public function dashboard()
    {


        $totalEmployees =
            $this->managerModel
            ->getTotalEmployees();



        /*$totalCustomers =
            $this->managerModel
            ->getTotalCustomers();*/

        $totalCustomers = 0;



        require __DIR__
        . '/../views/dashboard/index.php';


    }







    /*
    ==================================
        REVENUE ANALYTICS
    ==================================
    */


    public function revenueReport()
    {


        $totalRevenue =
            $this->managerModel
            ->getTotalRevenue();



        $monthlyRevenue =
            $this->managerModel
            ->getMonthlyRevenue();



        $totalBookings =
            $this->managerModel
            ->getTotalBookings();



        require __DIR__
        . '/../views/manager/revenue-report.php';


    }
    public function employeeRanking()
{


    $ranking =
        $this->managerModel
        ->getEmployeeRanking();



    require __DIR__
    . '/../views/manager/employee-ranking.php';


}
public function peakHourAnalysis()
{


    $peakHours =
        $this->managerModel
        ->getPeakHourAnalysis();



    require __DIR__
    . '/../views/manager/peak-hour-analysis.php';


}







    /*
    ==================================
        USERS
    ==================================
    */


    public function users()
    {


        $staff =
            $this->managerModel
            ->getAllStaff();



        require __DIR__
        . '/../views/manager/users.php';


    }









    /*
    ==================================
        ADD STAFF
    ==================================
    */


    public function addStaff()
    {


        if($_SERVER['REQUEST_METHOD']=='POST')
        {


            $this->managerModel
            ->createStaff(

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


    public function editStaff()
    {


        $id =
            $_GET['id'] ?? null;



        $staff =
            $this->managerModel
            ->getStaffById($id);



        require __DIR__
        . '/../views/manager/edit-staff.php';


    }







    public function updateStaff()
    {


        if($_SERVER['REQUEST_METHOD']=='POST')
        {


            $this->managerModel
            ->updateStaff(

                $_POST['id'],
                $_POST['full_name'],
                $_POST['email'],
                $_POST['username'],
                $_POST['role'],
                $_POST['status']

            );



            header(
                "Location: index.php?page=manager-users"
            );


            exit;

        }


    }








    public function deleteStaff()
    {


        $id =
            $_GET['id'] ?? null;



        if($id)
        {

            $this->managerModel
            ->deleteStaff($id);

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


    public function services()
    {


        $services =
            $this->serviceModel
            ->getAllServices();



        require __DIR__
        . '/../views/manager/services.php';


    }









    /*
    ==================================
        EMPLOYEE MANAGEMENT
    ==================================
    */


    public function employees()
    {


        if(!empty($_GET['search']))
        {


            $employees =
                $this->managerModel
                ->searchEmployees(
                    $_GET['search']
                );


        }
        else
        {


            $employees =
                $this->managerModel
                ->getAllEmployees();


        }




        require __DIR__
        . '/../views/manager/employees.php';


    }







    public function addEmployee()
    {


        if($_SERVER['REQUEST_METHOD']=='POST')
        {


            $this->managerModel
            ->createEmployee(

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








    public function editEmployee()
    {


        $id =
            $_GET['id'] ?? null;



        $employee =
            $this->managerModel
            ->getEmployeeById($id);



        require __DIR__
        . '/../views/manager/edit-employee.php';


    }








    public function updateEmployee()
    {


        if($_SERVER['REQUEST_METHOD']=='POST')
        {


            $this->managerModel
            ->updateEmployee(

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







    public function deleteEmployee()
    {


        $id =
            $_GET['id'] ?? null;



        if($id)
        {

            $this->managerModel
            ->deleteEmployee($id);

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


public function searchEmployee()
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


    WHERE full_name LIKE ?

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



    $data = [];



    while($row =
        mysqli_fetch_assoc($result))
    {


        $data[] = $row;


    }




    $employees = $data;


require __DIR__
. '/../views/manager/employee-table.php';


exit;


}



}

?>