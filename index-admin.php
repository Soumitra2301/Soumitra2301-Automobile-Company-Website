<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_admin($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Home</title>
    <link rel="stylesheet" href="view-car.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><b href="index-admin.php">Home</b></li>
                <li><a href="admin_book_request.php">Booking</a></li>
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
    
	<section class="heading">
    <h2>Current Stock</h2>
	</section>
	<div class="product-row">
<?php


// Fetch car data from the database
$sql = "SELECT * FROM cars";
$result = mysqli_query($con, $sql);

// Loop through the results and generate product cards
while ($row = mysqli_fetch_assoc($result)) {
	if($row['status']==1){
    echo "<div class='product-card'>";
    echo "<img src='" . $row['image'] . "' alt='Car Image'>";
    echo "<h2>" . $row['company'] . "</h2>";
    echo "<p>" . $row['model'] . "</p>";
    echo "<p>From $" . $row['price'] . "</p>";
    echo "</div>";
	}
}

// Close the database connection

?>
</div><br><br>
<section class="heading">
    <h2>Sold Units</h2>
	</section>
	
	<div class="product-row">
<?php


// Fetch car data from the database
$sql = "SELECT * FROM cars";
$result = mysqli_query($con, $sql);

// Loop through the results and generate product cards
while ($row = mysqli_fetch_assoc($result)) {
	if($row['status']==0){
    echo "<div class='product-card'>";
    echo "<img src='" . $row['image'] . "' alt='Car Image'>";
    echo "<h2>" . $row['company'] . "</h2>";
    echo "<p>" . $row['model'] . "</p>";
    echo "<p>From $" . $row['price'] . "</p>";
    echo "</div>";
	}
}

// Close the database connection
mysqli_close($con);
?>
</div>
	
    
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>