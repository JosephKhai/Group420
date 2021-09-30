<!doctype html>
<html>

<head>
    <title>Login Page</title>
    <meta name="description" content="index">
    <meta name="keywords" content="index">
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>
    <ul class="topnav">
        <li><a class="active" href="index.php">Home</a></li>
        <li class="right"><a href="About.html">About</a></li>
    </ul>

    <div>
        <h1>Login Page</h1>
    </div>


    <?php

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //if session is login_user
    if (isset($_SESSION['login_user'])) {
        header("location: manager.php");
    }


    $error = "";
    require_once "settings.php";    // Load MySQL log in credentials
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

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
            //to prevent MySql injection
            $username = sanitise_input($username);
            $password = sanitise_input($password);

            $query = "SELECT * FROM userlogin WHERE userpassword='$password' AND username ='$username' ";
            $result = mysqli_query($conn, $query);

            if ($result) { //if successful
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: homepage.php"); //redirecting to manager page. 
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
        <form method="post" action="index.php">
            <fieldset>
                <p>
                    <label for="name">Username :</label>
                    <input type="text" id="username" name="username" placeholder="username" />
                </p>
                <p>
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" placeholder="**********" />
                </p>
                <p>
                    <input name="submit" type="submit" value="Login " />
                <p>Don't have Account? <a href="signup.php">Sign Up here</a></p>
                </p>


            </fieldset>

        </form>


    </div>

</body>

</html>