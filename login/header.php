<?php

$corner_image = "../img/user_male.jpg";
if (isset($user_data)) {

    $image_class = new Image();
    $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
}




?>
<div class="blue_bar">
    <div class="stl">
        <a href="index.php"> My Book </a> &nbsp;&nbsp;<input type="text" id="search" placeholder="Search for people">

        &nbsp; &nbsp;&nbsp; &nbsp;
        <a href="profile.php">
            <img src="<?php echo $corner_image; ?>" alt="img noo" style="height:40px; border-radius: 50%;">
        </a>

        <span id="logout">
            <a href="logout.php">
                Logout &nbsp; &nbsp;
            </a>
        </span><!-------span doesn't creates new lines so used span--->



    </div>
</div>