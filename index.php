<?php include 'db.php'; 
?>
<!Doctype html>
<html>
    <Head>
        <title>Pos_System</title>
        <link rel="stylesheet" href="style.css">
        <div Style="text-align:right;">
            Welcome, <?php echo $_SESSION['username']; ?> |
            <a href="logout.php" style="color:red;">logout</a>
</div>
</head>
<body>
    <h1> Pos_System</h1>
    <div class="container">

    <div class="products">
        <h2>Products</h2>
        <?php
        $result = $conn->query("SELECT * FROM products");
        while($row = $result->fetch_assoc()){
            echo "<div class='product'>
                    <span>{$row['product_name']} - \$ {$row['price']} - Stock: {$row['stock']}</span>
                    <button onclick=\"addTocart({$row['id']}, '{$row['product_name']}', {$row['price']})\">Add</button>
                    </div>";
        }
        ?>
        </div>

        <div class="cart">
            <h2>Cart</h2>
            <div id="cart-items">No items</div>
            <h3>Total: $<span id="Total">0.00</span></h3>
            <button class="checkout- btn" onclick="Checkout()">Checkout</button>
    </div>

    </div>
    <script src="script.js"></script>
    </body>
        </html>