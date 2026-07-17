<?php include 'db.php';

if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select * FROM user where username = ?");
    $stmt->bind_param("$", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if(user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; 
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");

    }else {
        $error = "Invalid Username or Password";
    }
}
?>


<!Doctype html>
<html>
    <head>
    <head><title>POS LOGIN FORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-box {width:300px; margin: 100px; background: white; padding: 30px; border-radius: 8px; box shadow: 0 2px 10px rgba(0,0,0,0.1);}
        .login-box input { width:100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
        .error {color: red; text-align: center; }

   </style>
    </head>
    <body style="background:f4f4f4;"> 
     <div class="login-box">
      <h2 style="text-align:center;"> POS Login</h2>
        <?php if(isset($error)) echo "<p> class='error'>$error</p>"; ?>
         <form action="/action_page.php" method="Post">      
          <label>username</label>
	<input type="text" id="username" required><br><br>

	<label>Password</label>
	<input type="text" id="" required><br><br>
    
     
     <input type="button" value="LOGIN" onclick="Login()">
         </form>
         <p style="text-align:center; font-size:12px;">default: admin / 1234</p>
	
         </div>
            </body>
            </html>
<!DOCTYPE html>
<html>
<head>
<title>POS Login</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-box">
<h2>POS SYSTEM</h2>
<?php
if($error!=""){
echo "<div class='error'>$error</div>";
}
?>
<form method="POST">
<input
type="text"
name="username"
placeholder="Username"
required>
<input
type="password"
name="password"
placeholder="Password"
required>
<button
type="submit"
name="login">
Login
</button>
</form>
</div>
</body>
</html>


