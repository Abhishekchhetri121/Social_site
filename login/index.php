<?php



include("../classes/loader.php");



$login = new Login();
$user_data = $login->check_login($_SESSION['SOCIAL_userid']);

$p = new POST();
$id = $_SESSION['SOCIAL_userid'];
$result = $p->get_posts($id);


?>
<html>

<head>
    <title>Profile | My Book</title>
    <link rel="stylesheet" href="../css/p.css">
    <link rel="stylesheet" href="../css/pp.css?v=1">
</head>

<body>
    <!----nav bar -->
    <?php include('header.php'); ?>
    <!----cover area--->
    <div id="container">

        <!-----below - cover--->
        <div id="mid-panel">
            <!---mates-->
            <div id="d1">
                <img src="<?php echo $corner_image; ?>" alt="" id="pics"><br>
                &nbsp;&nbsp;&nbsp;<a href="profile.php"><?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?></a>

            </div>

            <!---posts area--->
            <div id="d2">
                <div id="id2">
                    <form action="" method="post">
                        <textarea name="post" placeholder="What's on Your mind?"></textarea>
                        <input type="submit" id="post_btn" value="post"><br><br>
                    </form>
                </div>


                <!----posts --->
                <div id="post_bar">
                    <?php
                    if ($result) {
                        foreach ($result as $row) {

                            $user = new User();
                            $row_user = $user->get_user($row['postid']);

                            include('post.php');
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>