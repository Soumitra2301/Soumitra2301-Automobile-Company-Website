<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_admin($con);

// Check if the form is submitted to accept or delete a booking request
if (isset($_POST['accept_request'])) {
    // Get the order ID from the form
    $order_id = $_POST['orderid'];
	$car = $_POST['carid'];

    // Update the order status to "Accepted" in the "orders" table
    $sql = "UPDATE orders SET confirm = 2 WHERE orderid = $order_id";
    mysqli_query($con, $sql);
	$sql1 = "DELETE from orders where confirm = 1 and carid = $car";
	mysqli_query($con, $sql1);
	$sql2 = "Update cars set status = 2 where carid = $car";
	mysqli_query($con, $sql2);
	
} elseif (isset($_POST['delete_request'])) {
    // Get the order ID from the form
    $order_id = $_POST['orderid'];

    // Delete the order from the "orders" table
    $sql = "DELETE FROM orders WHERE orderid = $order_id";
    mysqli_query($con, $sql);
}

// Fetch pending booking requests for the admin to review
$sql = "SELECT * FROM orders WHERE confirm = 1";
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
                <li><b href="admin_book_request.php">Booking</b></li>
                <li class="dropdown">
                <a href="#">Sell</a>
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
        <h2>Booking Requests</h2>
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
                echo "<button type='submit' class='cancel-request' name='accept_request'>Accept</button>";
                echo "<button type='submit' class='cancel-request' name='delete_request'>Delete</button>";
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
