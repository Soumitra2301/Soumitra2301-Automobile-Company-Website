<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);

$id = $user_data['id'];
$sql = "SELECT * FROM orders WHERE id = $id AND confirm = 2";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Book Requests</title>
    <link rel="stylesheet" href="design.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add any additional CSS styles specific to book-request.php here -->
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                <b href="#">Book Request</b>
                <div class="dropdown-content">
                    <a href="book_request.php">Pending Request</a>
                    <a href="approved_request.php">Approved Request</a>
                </div>
                </li>
				<li><a href="profile.php">Profile</a></li>
                <li><a href="about-index.php">About Us</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <section class="book-requests">
        <h2>Booked cars</h2>
        <ul>
            <?php
			
            while ($row = mysqli_fetch_assoc($result)) {
				if($row['confirm']==2){
                $car_id = $row['carid'];
                $car_sql = "SELECT * FROM cars WHERE carid = $car_id";
                $car_result = mysqli_query($con, $car_sql);
                $car_row = mysqli_fetch_assoc($car_result);

                echo "<li class='request-item'>";
                echo "<div class='request-details'>";
                echo "<h3>" . $car_row['company'] . " " . $car_row['model'] . "</h3>";
                echo "<p>Price: $" . $car_row['price'] . "</p>";
                echo "</div>";
                echo "<div class='request-actions'>";
                echo "<h2>Approved</h2>";
                echo "</div>";
                echo "</li>";
				}
            }

            ?>
        </ul>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>

