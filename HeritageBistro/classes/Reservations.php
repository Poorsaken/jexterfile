<?php

class Reservations{
public $id;

function CustomerReservationInsert($req) {
    global $con;

    $customer_name = $req['customer_name'];
    $time = $req['time'];
    $date = $req['date'];
    $phone_number = $req['phone_number'];
    $guest = $req['guest'];

    try {
        // Prepare and execute the SQL statement
        $sql = "INSERT INTO `tbl_reservation` (customer_name, time, date, phone_number, guest) 
                VALUES (:customer_name, :time, :date, :phone_number, :guest)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':guest', $guest);
        $stmt->execute();

        // Success alert and redirection
        echo "<script>alert('Inserted Successfully'); window.location.href='CustomerReservation.php';</script>";
        exit(); // Ensure no further code is executed after redirection

    } catch (PDOException $e) {
        // Output a JavaScript snippet to trigger an alert for error
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
}

?>