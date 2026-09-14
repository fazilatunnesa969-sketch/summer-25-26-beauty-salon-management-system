<?php


class Service
{

    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }



    public function getAllServices()
    {

        $query = "
            SELECT *
            FROM services
            ORDER BY id DESC
        ";


        $result =
            mysqli_query(
                $this->conn,
                $query
            );


        $services = [];


        while($row = mysqli_fetch_assoc($result))
        {

            $services[] = $row;

        }


        return $services;

    }





    public function createService(
        $name,
        $category,
        $price,
        $duration
    )
    {


        $status = "active";


        $query = "
            INSERT INTO services
            (
                service_name,
                category,
                price,
                duration,
                status
            )

            VALUES
            (?, ?, ?, ?, ?)
        ";


        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );


        mysqli_stmt_bind_param(
            $stmt,
            "ssdss",
            $name,
            $category,
            $price,
            $duration,
            $status
        );


        return mysqli_stmt_execute($stmt);

    }





    public function deleteService($id)
    {


        $query = "
            DELETE FROM services
            WHERE id = ?
        ";


        $stmt =
            mysqli_prepare(
                $this->conn,
                $query
            );


        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id
        );


        return mysqli_stmt_execute($stmt);

    }


}

?>