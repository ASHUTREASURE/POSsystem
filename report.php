<?php
include 'db.php';
if(!isset($_SESSION['username'])){
 header("Location: login.php");
 exit();
}
// Count products
$product = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM
products"));
// Count customers
$customer = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM
customers"));
// Count sales
$sale = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sales"));
// Calculate total revenue
$totalSales = mysqli_query($conn,"SELECT SUM(total) AS revenue FROM sales");
$data = mysqli_fetch_assoc($totalSales);
$revenue = $data['revenue'];
if($revenue == ""){
 $revenue = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="sidebar">
<h2>POS SYSTEM</h2>
<a href="dashboard.php">Dashboard</a>
<a href="products.php">Products</a>
<a href="customers.php">Customers</a>
<a href="checkout.php">Checkout</a>
<a href="sales.php">Sales</a>
<a href="reports.php">Reports</a>
<a href="logout.php">Logout</a>
</div>
<div class="main">
<h1>Reports</h1>
<div class="card">
<h2>Total Products</h2>
<h3><?php echo $product; ?></h3>
</div>
<div class="card">
<h2>Total Customers</h2>
<h3><?php echo $customer; ?></h3>
</div>
<div class="card">
<h2>Total Sales</h2>
<h3><?php echo $sale; ?></h3>
</div>
<div class="card">
<h2>Total Revenue</h2>
<h3>FCFA <?php echo number_format($revenue,2); ?></h3>
</div>
</div>
</body>
</html>