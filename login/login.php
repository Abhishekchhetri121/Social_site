<?php



include("../classes/loader.php");

$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = new Login();
    $result = $login->evaluate($_POST);
    //echo $result . "yoo";

    if ($result != "") {

        echo "<div style='text-align:center; font-size:12px; background-color:gray; color:white '>";
        echo "The following error occured<br>";
        echo $result;
        echo "</div>";
    } else {
        header("Location: profile.php");
        die();
    }



    $email = $_POST['email'];
    $password = $_POST['password'];
}

?>

<html>

<head>

    <title>Document</title>
    <link rel="stylesheet" href="../css/log.css?v=1">

</head>

<body>
    <header>
        <nav>
            <div class="bar">Social Site

            </div>
            <div class="sign">SignUp</div>
        </nav>
    </header>
    <div class="main">
        <form method="post">
            Log in to sites<br><br>
            <input name="email" value="<?php echo $email; ?>" type="text" id="t1" placeholder="Email address or Phone number"><br><br>
            <input name="password" value="<?php echo $password; ?>" type="password" id="t1" placeholder="Password"><br><br>
            <input type="submit" name="submit" id="btn" value="Log in">
        </form>
    </div>


</body>

</html>