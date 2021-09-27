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
        <li><a href="AddSales.html">Add Sales</a></li>
        <li><a href="UpdateStock.html">Update Stock</a></li>
        <li><a href="SalesReport.php">Sales Report</a></li>
        <li class="right"><a href="About.html">About</a></li>
    </ul>

    <div>
        <h1>Signup Page</h1>
    </div>

    <?php

    require_once "settings.php";    // Load MySQL log in credentials
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database


    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $error = "";
    require_once "settings.php";    // Load MySQL log in credentials
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

    if (isset($_POST['submit'])) {

        //get the data from the signup form

        $username = $_POST["username"];
        $username = sanitise_input($username);
        $email = $_POST["email"];
        $email = sanitise_input($email);
        $password = $_POST["password"];
        $password = sanitise_input($password);

        session_start();

        if (isset($_POST["submit"])) {
            if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
                $error = "Please enter email, username and password";
            } else {
                //define username and password
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                //to prevent MySql injection
                $username = sanitise_input($username);
                $password = sanitise_input($password);
                $email = sanitise_input($email);

                $query = "CREATE TABLE IF NOT EXISTS Login_(
                    id int(10) NOT NULL AUTO_INCREMENT,
                    email varchar(255) NOT NULL,
                    username varchar(255) NOT NULL,
                    password_ varchar(255) NOT NULL,
                    PRIMARY KEY (id)
                    )";

                //execute the query -we should really check to see if the database exists first.
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $query = "INSERT INTO Login_(email, username, password_) VALUES ('$email','$username', '$password'); ";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        header("location: admin.php");
                        exit();
                    }
                } else {
                    $error = "Signup Not success!";
                }

                mysqli_close($conn); //closing connection

            }
        }
    }

    ?>

    <!--Signup form Section-->

    <section class="signup-form">
        <h3>Please fill the form below!</h3>
        <form method="post" action="AddSales.html">
            <fieldset>
                <p>
                    <label for="name">E-mail :</label>
                    <input type="text" id="email" name="email" placeholder="email" />
                </p>
                <p>
                    <label for="name">Username :</label>
                    <input type="text" id="name" name="username" placeholder="username" />
                </p>
                <p>
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" placeholder="**********" />
                </p>
                <p>
                    <input name="submit" type="submit" value="Sign Up" />
                <p>Already have Account? <a href="index.php">Sign In here</a></p>
                </p>


            </fieldset>

        </form>

    </section>

</body>

</html>