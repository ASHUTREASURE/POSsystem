<?php
include 'db.php';
if(!isset($_SESSION['username'])){
 header("Location: login.php");
 exit();
}
$sales = mysqli_query($conn,"SELECT * FROM sales ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Sales History</title>
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
<h1>Sales History</h1>
<table border="1"; width="100%"; cellpadding="10">
<tr>
<th>Sale ID</th>
<th>Total (FCFA)</th>
<th>Payment (FCFA)</th>
<th>Balance (FCFA)</th>
<th>Date</th>
</tr>
<?php
while($row = mysqli_fetch_assoc($sales)){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo number_format($row['total'],2); ?></td>
<td><?php echo number_format($row['payment'],2); ?></td>
<td><?php echo number_format($row['balance'],2); ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php
}
?>
</table>
</div>
</body>
</html>
