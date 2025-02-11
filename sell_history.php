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
                    <a href="#">Sell history</a>
                </div>
                </li>
                <li><a href="add-car.php">Add Cars</b></li>
                <li><a href="manage_user.php">Manage Users</b></li>
                <li><a href="adminlogout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <section class="sell-info">
        <h2>Sell Information</h2>
        <table>
            <thead>
                <tr>
                    <th>Sell ID</th>
                    <th>Customer Name</th>
                    <th>Car Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Sell Date</th>
                    <!-- Add additional table headers for other information if needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to retrieve sell information
                $sql = "SELECT s.sell_id, u.user_name, c.company, c.model, c.price, s.Date
                        FROM sell s
                        INNER JOIN users u ON s.Cus_id = u.id
                        INNER JOIN cars c ON s.carid = c.carid
                        ORDER BY s.Date DESC"; // Adjust the query as needed

                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['sell_id'] . "</td>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>" . $row['company'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>$" . $row['price'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    // Add additional table cells for other information if needed
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>
