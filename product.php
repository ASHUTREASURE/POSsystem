<?php
include 'db.php';
if(!isset($_SESSION['username'])){
 header("Location: login.php");
 exit();
}
/* Add Product */
if(isset($_POST['save'])){
 $name = mysqli_real_escape_string($conn,$_POST['product_name']);
 $barcode = mysqli_real_escape_string($conn,$_POST['barcode']);
 $price = $_POST['price'];
 $quantity = $_POST['quantity'];
 mysqli_query($conn,"INSERT INTO products(product_name,barcode,price,quantity)
 VALUES('$name','$barcode','$price','$quantity')");
 header("Location: products.php");
 exit();
}
/* Delete Product */
if(isset($_GET['delete'])){
 $id = (int)$_GET['delete'];
 mysqli_query($conn,"DELETE FROM products WHERE id='$id'");
 header("Location: products.php");
 exit();
}
$result = mysqli_query($conn,"SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Products</title>
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
<h1>Products</h1>
<form method="POST">
<input
type="text"
name="product_name"
placeholder="Product Name"
required>
<input
type="text"
name="barcode"
placeholder="Barcode"
required>
<input
type="number"
step="0.01"
name="price"
placeholder="Price"
required>
<input
type="number"
name="quantity"
placeholder="Quantity"
required>
<button
type="submit"
name="save">
Add Product
</button>
</form>
<br><br>
<table cellpadding="10"; cellspacing="1"; width="100%";>
<tr>
<th>ID</th>
<th>Product</th>
<th>Barcode</th>
<th>Price</th>
<th>Quantity</th>
<th>Action</th>
</tr>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['product_name']; ?></td>
<td><?php echo $row['barcode']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td>
<a href="products.php?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this product?')">
Delete
</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>