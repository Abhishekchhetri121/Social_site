<?php

include("../classes/loader.php");

$login = new Login();
$user_data = $login->check_login($_SESSION["SOCIAL_userid"]);

$profile = new Profile();
if (isset($_GET['id']) and is_numeric($_GET['id'])) {
    $profile_data = $profile->get_profile($_GET['id']);


    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}


//posting starts here

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $post = new POST();
    $id = $_SESSION['SOCIAL_userid'];
    $result = $post->create_post($id, $_POST, $_FILES);


    if ($result == "") {
        header("Location: profile.php");
        die();
    } else {

        echo "<div style='text-align:center; font-size:12px; background-color:gray; color:white '>";
        echo "The following error occured<br>";
        echo $result;
        echo "</div>";
    }
}

//posts collection
$p = new POST();
$id = $user_data['userid'];
$result = $p->get_posts($id);

//friends collection
$user = new User();

$friends = $user->get_friends($id);

$image_class = new Image();


?>


<html>

<head>
    <title>Profile | My Book</title>
    <link rel="stylesheet" href="../css/p.css">
    <!---<link rel="stylesheet" href="../css/pp.css">--->
</head>

<body>
    <!----nav bar -->
    <?php include('header.php'); ?>

    <!----cover area--->
    <div id="container">
        <div id="imgh">
            <?php
            $image = "../img/cover_image.jpg";
            if (file_exists($user_data['cover_image'])) {
                $image = $image_class->get_thumb_cover($user_data['cover_image']);
            }
            ?>

            <img src="<?php echo $image ?>" alt="">
            <?php
            $image = "../img/user_male.jpg";
            if ($user_data['gender'] == "female") {
                $image = "../img/user_female.jpg";
            }
            if (file_exists($user_data['profile_image'])) {
                $image = $image_class->get_thumb_profile($user_data['profile_image']);
            }
            ?>
            <img src="<?php echo $image ?>" alt="" id="pics">
            <br>


            <a href="change_profile.php?change=profile">Change Profile</a> |
            <a href="change_profile.php?change=cover">Change Cover</a>
            <div id="nn">
                <?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?>
            </div>
            <br>

            <div id="menus"><a href='index.php'>Timeline</a></div>
            <div id="menus"> About</div>
            <div id="menus"> Friends</div>
            <div id="menus">Photos</div>
            <div id="menus">Settings</div>
        </div>
        <!-----below - cover--->
        <div id="mid-panel">
            <!---mates-->
            <div id="d1">
                <div id="fbar">
                    Friends

                    <?php
                    if ($friends) {
                        foreach ($friends as $row) {
                            include('user.php');
                        }
                    }
                    ?>

                </div>

            </div>

            <!---posts area--->
            <div id="d2">
                <div id="id2">
                    <form action="" method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="What's on Your mind?"></textarea>
                        <input type="file" name="file">
                        <input type="submit" id="post_btn" value="post"><br><br>
                    </form>
                </div>
                <!----posts --->
                <div id="post_bar">
                    <!----posts 1 --->
                    <!----posts - 1 ending -->
                    <!----posts 2 --->
                    <!----posts - 2 ending -->

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