<div id="friends">
    <?php $image = "../img/user_male.png";

    if ($row['gender'] == "female") {
        $image = "../img/user_female.png";
    }

    if (file_exists($row['profile_image'])) {

        $image = $image_class->get_thumb_profile($row['profile_image']);;
    }
    ?>

    <a href="profile.php?id=<?php echo $row['userid']; ?>">
        <img id="fimg" src="<?php echo $image; ?>" alt="" srcset=""><br>
        <?php echo $row['first_name'] . " " . $row['last_name']; ?>
    </a>
</div>