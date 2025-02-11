<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	
	// Fetch pending booking requests for the logged-in user
$id = $user_data['id'];
$sql = "SELECT carid FROM orders WHERE id = $id AND confirm = 1";
$result = mysqli_query($con, $sql);

// Create an array to store requested car IDs
$requested_cars = array();
while ($row = mysqli_fetch_assoc($result)) {
    $requested_cars[] = $row['carid'];
}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><b href="#">Home</b></li>
                <li class="dropdown">
                <a href="#">Book Request</a>
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
    <section class="hero">
        <h1>WELCOME TO YOUR</h1>
		<h2>ST-MOTORS EXPERIENCE</h2>
        <a href="View-car-index.php" class="cta-button">View Cars</a>
    </section>
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
	echo "<form method='post' action='book_request.php'>";
    echo "<input type='hidden' name='car_id' value='" . $row['carid'] . "'>";
     if (in_array($row['carid'], $requested_cars)) {
        echo "<button type='button' class='add-to-cart'>Requested</button>";
    } else {
        echo "<button type='submit' class='add-to-cart' name='book_car'>Book</button>";
    }
    echo "</form>";
    echo "</div>";
	}
	
	elseif($row['status']==2){
    echo "<div class='product-card'>";
    echo "<img src='" . $row['image'] . "' alt='Car Image'>";
    echo "<h2>" . $row['company'] . "</h2>";
    echo "<p>" . $row['model'] . "</p>";
    echo "<p>From $" . $row['price'] . "</p>";
    echo "<button type='submit' class='add-to-cart' name='book_car'>Booked</button>";
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