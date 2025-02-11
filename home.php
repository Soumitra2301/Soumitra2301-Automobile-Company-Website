<?php 
session_start();

	include("connection.php");
	include("functions.php");

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css"?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><b href="#">Home</b></li>
                <li><a href="about-home.php">About Us</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h1>WELCOME TO YOUR</h1>
		<h2>ST-MOTORS EXPERIENCE</h2>
        <a href="view-car-home.php" class="cta-button">View Cars</a>
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