<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_admin($con);

if (isset($_POST['cancel_booking'])) {
    // Get the order ID from the form
    $order_id = $_POST['orderid'];
	$car = $_POST['carid'];

    // Update the order status to "Accepted" in the "orders" table
    $sql = "UPDATE cars SET status = 1 WHERE carid = $car";
    mysqli_query($con, $sql);
	$sql1 = "DELETE from orders where orderid = $order_id";
	mysqli_query($con, $sql1);
	
} elseif (isset($_POST['sell'])) {
    
    $order_id = $_POST['orderid'];
	$car = $_POST['carid'];
	$customer = $_POST['id'];

    
    $sql = "insert into sell (orderid,Cus_id,carid) values ($order_id,$customer,$car)";
    mysqli_query($con, $sql);
	
	$sql1 = "UPDATE cars SET status = 0 WHERE carid = $car";
	mysqli_query($con, $sql1);
	
	$sql2 = "update orders set confirm = 3 where orderid = $order_id";
	mysqli_query($con, $sql2);
}

$sql = "SELECT * FROM orders WHERE confirm = 2";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booking Requests</title>
    <link rel="stylesheet" href="design.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add any additional CSS styles specific to admin_book_requests.php here -->
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><a href="index-admin.php">Home</a></li>
                <li><a href="admin_book_request.php">Booking</a></li>
                <li class="dropdown">
                <b href="#">Sell</b>
                <div class="dropdown-content">
                    <a href="admin_approved_request.php">Sell</a>
                    <a href="sell_history.php">Sell history</a>
                </div>
                </li>
                <li><a href="add-car.php">Add Cars</b></li>
                <li><a href="manage_user.php">Manage Users</b></li>
                <li><a href="adminlogout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <section class="book-requests">
        <h2>Booked Cars</h2>
        <ul>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
				$user_id = $row['id'];
                $car_id = $row['carid'];
                $car_sql = "SELECT * FROM cars WHERE carid = $car_id";
                $car_result = mysqli_query($con, $car_sql);
                $car_row = mysqli_fetch_assoc($car_result);
				$user_sql = "SELECT * FROM users WHERE id = $user_id";
				$user_result = mysqli_query($con, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);

                echo "<li class='request-item'>";
                echo "<div class='request-details'>";
                echo "<h3>" . $car_row['company'] . " " . $car_row['model'] . "</h3>";
                echo "<p>Price: $" . $car_row['price'] . "</p>";
                echo "<p>User ID: " . $user_row['id'] . "</p>";
                echo "<p>User Name: " . $user_row['user_name'] . "</p>";
                echo "</div>";
                echo "<div class='request-actions'>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='orderid' value='" . $row['orderid'] . "'>";
				echo "<input type='hidden' name='carid' value='" . $row['carid'] . "'>";
				echo "<input type='hidden' name='id' value='" . $user_row['id'] . "'>";
                echo "<button type='submit' class='cancel-request' name='cancel_booking'>Cancel booking</button>";
                echo "<button type='submit' class='cancel-request' name='sell'>sell</button>";
                echo "</form>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>
