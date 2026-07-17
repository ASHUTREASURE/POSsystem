<?php 
include 'db.php'; 
if(!isset($_SESSION['username'])) { 
header("Location: login.php"); 
exit(); 
} 
if(isset($_POST['save'])){ $fullname = mysqli_real_escape_string($conn,
$_POST['fullname']); $phone = mysqli_real_escape_string($conn,
$_POST['phone']); $address = mysqli_real_escape_string($conn,
$_POST['address']); mysqli_query($conn,"INSERT INTO customers(fullname,phone,address) VALUES('$fullname','$phone','$address')");
header("Location: customers.php"); exit(); } 
if(isset($_GET['delete'])){ $id = (int)$_GET['delete']; mysqli_query($conn,"DELETE FROM customers WHERE id='$id'"); header("Location: customers.php"); exit(); }
$customers = mysqli_query($conn,"SELECT * FROM customers ORDER BY id DESC"); 
?> 
<!DOCTYPE html> 
<html> 
<head> <title>Customers</title> 
<link rel="stylesheet" href="css/style.css"> 
</head> 
<body> 
<div class="sidebar">
<h2>POS SYSTEM</h2> 
<a href="dashboard.php">Dashboard</a> 
<a href="products.php">Products</a> <a href="customers.php">Customers</a>
<a href="checkout.php">Checkout</a> <a href="sales.php">Sales</a> 
<a href="reports.php">Reports</a> <a href="logout.php">Logout</a> 
</div> 
<div class="main"> 
<h1>Customer Management</h1> 
<form method="POST"> 
    <input type="text" name="fullname" placeholder="Customer Name" required> 
    <input type="text" name="phone" placeholder="Phone Number" required> 
    <textarea name="address" placeholder="Customer Address" required></textarea><br><br> 
<button type="submit" name="save"> Save Customer </button> 
</form> <br>
 <table border="1"> <tr> 
<th>ID</th> 
<th>Customer</th> 
 <th>Phone</th> 
 <th>Address</th> 
 <th>Action</th> 
 </tr> 
 
 <?php
while($row=mysqli_fetch_assoc($customers)) { 
?> 
<tr> <td>

<?php echo $row['id']; 
?>
</td> <td>
    <?php echo $row['fullname'];
    ?>
</td> <td>
    <?php echo $row['phone']; 
    ?>
    </td> <td>
        <?php echo $row['address']; 
        ?>
        </td> <td> 
            <a href="customers.php?delete= <?php echo $row['id']; ?>" onclick="return confirm('Delete Customer?')"> Delete </a> </td> </tr> <?php } 
            ?> 
            </table> 
        </div>
</body> 
</html> 