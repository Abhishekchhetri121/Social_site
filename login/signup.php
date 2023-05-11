<?php
include("../classes/loader.php");

$first_name = "";
$last_name = "";
$email = "";
$gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $signup = new SignUp();
    $result = $signup->evaluate($_POST);


    if ($result != "") {

        echo "<div style='text-align:center; font-size:12px; background-color:gray; color:white '>";
        echo "The following error occured<br>";
        echo $result;
        echo "</div>";
    } else {
        header("Location:login.php");
        die();
    }


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
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
        SignUp to Social Site<br><br>
        <form method="POST">
            <input value="<?php echo $first_name ?>" type="text" name="first_name" id="t1" placeholder="First name"><br><br>
            <input value="<?php echo $last_name ?>" type="text" name="last_name" id="t1" placeholder="Last name"><br><br>
            <span>Gender:</span><br>
            <select name="gender" id="t1">
                <option><?php echo $gender ?></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <br>
            <br>

            <input value="<?php echo $email ?>" type="text" name="email" id="t1" placeholder="Enter ur email"><br><br>
            <input type="password" name="password" id="t1" placeholder="Enter ur password"><br><br>
            <input type="password" name="password" id="t1" placeholder="Retype Password"><br><br>
            <input type="submit" name="submit" id="btn" value="Sign up">
        </form>

    </div>


</body>

</html>