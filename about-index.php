<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
    <style>
	
	
body, h1, h2, h3, p {
    margin: 0;
    padding: 0;
}


body {
    font-family: "consolas",Arial, sans-serif;
	background:black;
}

header {
	
	position:fixed;
	width:100%;
    background-color: black;
    color: white;
	padding: 10px 0;
}

nav {
	
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}



.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin-right: 20px;
}

.nav-links a {
    color: red;
	font-size:20px;
    text-decoration: none;
}

.nav-links b {
    color: white;
	font-size:20px;
    text-decoration: none;
}

.about-us{
  height: 65vh;
  width: 100%;
  padding: 90px 0;
  background:black;
}

.about{
  width: 1130px;
  max-width: 85%;
  margin: 0 auto;
  margin-top:30px;
  display: flex;
  align-items: center;
  justify-content: space-around;
}
.text{
  width: 540px;
}
.text h2{
  font-size: 70px;
  color: white;
  font-weight: 600;
  margin-bottom: -15px;

}
.text h5{
  font-size: 22px;
  color: white;
  font-weight: 500;
  margin-bottom: 20px;
}

.text p{
  font-size: 18px;
  color: white;
  line-height: 25px;
  letter-spacing: 1px;
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: black;
    color: white;
}
.dropdown {
    position: relative;
    display: inline-block;
}

/* Style for the dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Style for dropdown links */
.dropdown-content a {
    color: red;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s;
}

/* Style for dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
}

/* Show the dropdown content when hovering over the dropdown link */
.dropdown:hover .dropdown-content {
    display: block;
}

	
	
	</style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
				<li class="dropdown">
                <a href="#">Book Request</a>
                <div class="dropdown-content">
                    <a href="book_request.php">Pending Request</a>
                    <a href="approved_request.php">Approved Request</a>
                </div>
                </li>
				<li><a href="profile.php">Profile</a></li>
                <li><b href="about-index.php">About Us</b></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <section class="about-us">
    <div class="about">
      <div class="text">
        <h2>About Us</h2>
        <h5>Buy or Rent a car</h5>
          <p> At ST-MOTORS, we are passionate about automobiles. With a rich history spanning over two decades, we have become a trusted name in the automotive industry. Our mission is to provide our customers with the best vehicles and services in the market.</p>
		  <p>Thank you for choosing ST-MOTORS. We look forward to serving you and being a part of your automotive journey.</p>
        
      </div>
    </div>
    </section>
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>