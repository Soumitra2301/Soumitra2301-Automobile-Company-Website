<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);

// Check if the form is submitted to book a car
if (isset($_POST['cancel_booking'])) {
    // Get the car ID from the form
    $orderid = $_POST['orderid'];


    // Insert a new order into the "orders" table
    $sql = "delete from orders where orderid=$orderid";
    mysqli_query($con, $sql);

    // Redirect back to the index.php page after booking
    header("Location: book_request.php");
    exit();
}

?>


