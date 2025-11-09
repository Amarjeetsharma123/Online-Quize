<?php
    include_once 'database.php';
    session_start();
    if(isset($_SESSION["email"])) {
        session_destroy();
    }

    $ref=@$_GET['q'];
    if(isset($_POST['submit'])) {	
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1) {
            session_start();
            if(isset($_SESSION['email'])) {
                session_unset();
            }
            $_SESSION["name"] = 'Admin';
            $_SESSION["key"]  = 'admin';
            $_SESSION["email"] = $email;
            header("location:dashboard.php?q=0");
        } else {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Login | Online Quiz System</title>

<style>
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

    <?php echo file_get_contents("lamp.svg"); ?>

    <div class="login-form">
        <h2>Admin Login</h2>

        <form action="admin.php" method="post">
            
            <div class="form-group">
                <label for="email">Enter Your Email Id:</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Enter Admin Email"
                    required
                />
            </div>

            <div class="form-group">
                <label class="fw">Enter Your Password:
					<a href="javascript:void(0)" class="pull-right">Forgot Password?</a>
				</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                />
            </div>

            <button type="submit" name="submit" class="login-btn">
                Login
            </button>

            <button type="button" class="login-btn" onclick="window.location.href='login.php'">
    User Login

        </form>
    </div>

</div>

<script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
<script src="https://unpkg.com/gsap@3/dist/Draggable.min.js"></script>
<script src="https://assets.codepen.io/16327/MorphSVGPlugin3.min.js"></script>

<script>
<?php echo file_get_contents("lamp.js"); ?>
</script>

</body>
</html>
