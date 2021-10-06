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
        <li class="right"><a href="About.php">About</a></li>
    </ul>

    <div>
        <h1>Login Page</h1>
    </div>

    <?php

    require_once "settings.php";    // Load MySQL log in credentials
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

    $error = "username/password incorrect";
    session_start();

    if (isset($_POST["submit"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            echo '<script>alert("Both Fields are required")</script>';
        } else {
            //define username and password
            $username = $_POST["username"];
            $password = $_POST["password"];

            $username = stripslashes($username);
            $password = stripslashes($password);

            $username = mysqli_real_escape_string($conn, $username);
            $username = mysqli_real_escape_string($conn, $password);

            //$result = mysqli_query("SELECT * FROM userlogin WHERE username ='$username' AND  userpassword = '$password' ") or die("failed to query database", mysqli_error());

            $query = "SELECT * FROM userlogin WHERE username ='$username' AND  userpassword = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {


                while ($row = mysqli_fetch_array($result)) {

                    if ($row['username'] == $username && $row['userpassword'] == $password) {
                        //return true
                        $_SESSION['username'] = $username; // Initializing Session
                        header("location: homepage.php"); //redirecting to home page. 

                    } else {
                        //return false
                        //echo '<script>alert("Wrong User password")</script>';
                        $_SESSION["error"] = $error;
                    }
                }
            } else {
                // echo '<script>alert("Wrong User Details")</script>';
                $_SESSION["error"] = $error;
            }
        }
    }

    mysqli_close($conn); //closing connection

    ?>

    <!--Signin form Section-->

    <div class="login-form">
        <h3>Please Login</h3>

        <form method="post" action="index.php">
            <fieldset>
                <p>
                    <label for="name">Enter Username :</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="username" />
                </p>
                <p>
                    <label for="password">Enter Password :</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="**********" />
                </p>
                <p>
                    <span class="error">
                        <?php
                        if (isset($_SESSION["error"])) {
                            $error = $_SESSION["error"];
                            echo "<span>$error</span>";
                        }
                        ?>
                    </span>
                </p>

                <p>
                    <input name="submit" type="submit" value="Login " />
                </p>



            </fieldset>

        </form>

    </div>




    </div>

</body>

</html>
<?php
unset($_SESSION["error"]);
?>