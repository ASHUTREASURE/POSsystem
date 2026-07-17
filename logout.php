<?php
include 'db.php';
session_start();
session_destroy();
header("Location: login.php");

?>
<?php
include 'db.php';
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
   }
   $product = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM
   products"));
   $customer = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM
   customers"));
   $sales = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sales"));
   ?>
   <!DOCTYPE html>
   <html>
   <head>
   <title>Dashboard</title>
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
   <h1>Dashboard</h1>
   <h3>Welcome <?php echo $_SESSION['fullname']; ?></h3>
   <div class="card">
   <h2>Total Products</h2>
   <p><?php echo $product; ?></p>
   </div>
   <div class="card">
   <h2>Total Customers</h2>
   <p><?php echo $customer; ?></p>
   </div>
   <div class="card">
   <h2>Total Sales</h2>
   <p><?php echo $sales; ?></p>
   </div>
   </div>
   </body>
   </html>