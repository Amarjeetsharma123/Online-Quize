<?php
   require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['submit']))
	{	
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$email = stripslashes($email);
		$email = addslashes($email);
		$pass = stripslashes($pass); 
		$pass = addslashes($pass);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);					
		$str = "SELECT * FROM user WHERE email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			header('location: welcome.php?q=1'); 					
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login | Online Quiz System</title>

<!-- Same CSS from index.html -->
<style>
/* entire CSS copied exactly from index.html */
<?php echo file_get_contents("index.css"); ?>
</style>

</head>
<body>

<form class="radio-controls">
    <input type="radio" id="on" name="status" value="on" />
    <label for="on">On</label>
    <input type="radio" id="off" name="status" value="off" />
    <label for="off">Off</label>
</form>

<div class="container">

    <!-- SVG Lamp copied exactly -->
    <?php echo file_get_contents("lamp.svg"); ?>

    <div class="login-form">
        <h2>Login | Online Quiz System</h2>

        <!-- IMPORTANT: this form now uses your PHP POST fields -->
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Enter Your Email Id:</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Enter your Email"
                    required
                />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                />
            </div>

            <button type="submit" name="submit" class="login-btn">
                Login
            </button>

        <div class="form-group text-center">
		<span class="text-muted">Don't have an account?</span> <a href="register.php">Register</a> Here..
		</div>
		<button type="button" class="login-btn" onclick="window.location.href='admin.php'">
    Admin Login
</button>

        </form>

    </div>
</div>

<!-- Same JS from index.html -->
<script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
<script src="https://unpkg.com/gsap@3/dist/Draggable.min.js"></script>
<script src="https://assets.codepen.io/16327/MorphSVGPlugin3.min.js"></script>

<script>
<?php echo file_get_contents("lamp.js"); ?>
</script>

</body>
</html>
