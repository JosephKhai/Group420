<!doctype html>
<html>

<head>
    <title>Home</title>
    <meta name="description" content="index">
    <meta name="keywords" content="index">
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>
    <ul class="topnav">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="UpdateStock.html">Update Stock</a></li>
        <li><a href="SalesReport.php">Sales Report</a></li>
        <li class="right"><a href="About.html">About</a></li>
    </ul>

    <div>
        <h1>Home </h1>
    </div>

    <?php 

   
    //if session is login_user
    if (isset($_SESSION['login_user'])) {
        header("location: index.php"); 
    }

    $error = "";
    require_once "settings.php";    // Load MySQL log in credentials
    $conn = new mysqli($host, $user, $pwd, $sql_db);    // Log in and use database

    //connection to database
    require_once "settings.php";
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    
    session_start();
    
    $error = "";
    if (isset($_POST["submit"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $error = "Username or Password is Invalid";
            
        } else {
            //define username and password
            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = "SELECT * FROM Login_ WHERE password_='$password' AND username ='$username' ";
            $result = mysqli_query($conn, $query);

            

            $result = mysqli_query($conn, $query);

            if ($result) { //if successful
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: index.php"); //redirecting to addsales page. 
                exit();
            } else {
                $error = "Username or Password is invalid";
            }
            mysqli_close($conn); //closing connection


        }
    }


    ?>


    <!--Signin form Section-->

    <div class="login-form">
        <h3>Please Login</h3>
        <form method="post" action="AddSales.html">
            <fieldset>
                <p>
                    <label for="name">Username :</label>
                    <input type="text" id="name" name="username" placeholder="username" />
                </p>
                <p>
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" placeholder="**********" />
                </p>
                <p>
                    <input name="submit" type="submit" value=" Login " />
                <p>Don't have Account? <a href="signup.php">Sign Up here</a></p>
                </p>


            </fieldset>

        </form>


    </div>

</body>

</html>