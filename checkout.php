<?php
include 'db.php';
$data = Json_decode(file_get_contents('php:\\input'), true);
$cart = $data['cart'];
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
   }
   if(isset($_POST['sell'])){
    $product_id = $_POST['product'];
    $qty = $_POST['quantity'];
    $result = mysqli_query($conn,"SELECT * FROM products WHERE
   id='$product_id'");
    $product = mysqli_fetch_assoc($result);
    if($product['quantity'] >= $qty){
    $price = $product['price'];
    $total = $price * $qty;
    mysqli_query($conn,"INSERT INTO sales(total,payment,balance)
    VALUES('$total','$total','0')");
    $newQty = $product['quantity'] - $qty;
    mysqli_query($conn,"UPDATE products SET quantity='$newQty'
    WHERE id='$product_id'");
    echo "<script>alert('Sale Completed Successfully');</script>";
    }else{
    echo "<script>alert('Not Enough Stock');</script>";
    }
   }
foreach($cart as $item){
    $id = $item['id']
    $qty=  $item['qty']
    $total = $item['price'] * $qty;

$conn->query("insert into sales(product_id, qty, total)VALUES ($id, $qty, $total)");
$conn->query("update products set stock = stock - $qty WHERE  id=$id");
}

echo "sale completed successfully!";
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
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
<h1>Checkout</h1>
<form method="POST">
<label>Select Product</label>
<select name="product" required>
<option value="">Choose Product</option>
<?php
$products = mysqli_query($conn,"SELECT * FROM products");
while($row=mysqli_fetch_assoc($products)){
?>
<option value="<?php echo $row['id']; ?>">
<?php echo $row['product_name']; ?>
(Stock: <?php echo $row['quantity']; ?>)
</option>
<?php } ?>
</select>
<br><br>
<label>Quantity</label>
<input
type="number"
name="quantity"
required
min="1">
<br>
<button
type="submit"
name="sell">
Complete Sale
</button>
</form>
</div>
</body>
</html>
