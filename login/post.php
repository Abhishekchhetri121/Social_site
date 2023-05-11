<div id="posts">
    <div class="txt">
        <?php $image = "../img/user_male.png";

        if ($row_user['gender'] == "female") {
            $image = "../img/user_female.png";
        }

        if (file_exists($row_user['profile_image'])) {

            $image = $image_class->get_thumb_profile($row_user['profile_image']);;
        }

        ?>
        <img src="<?php echo $image; ?>" id="img_post" alt="">
    </div>
    <div style="width:100%">
        <div class="poster">

            <?php
            echo $row_user['first_name'] . " " . $row_user['last_name'];

            if ($row['is_profile']) {
                $pronoun = "his";
                if ($row_user['gender'] == "female") {
                    $pronoun = "her";
                }
                echo "<span style='color:RGB(0,0,125); font-weight:normal;'> Updated $pronoun Cover image</span>";
            }

            if ($row['is_cover']) {
                $pronoun = "his";
                if ($row_user['gender'] == "female") {
                    $pronoun = "her";
                }
                echo "<span style='color:RGB(0,0,125); font-weight:normal;'> Updated $pronoun Profile image</span>";
            }
            ?>
        </div>


        <?php echo $row['post']; ?>
        <br><br>
        <?php
        if (file_exists($row['image'])) {

            $post_image = $image_class->get_thumb_post($row['image']);

            echo "<img src='$post_image' style='width:100%' />";
        }
        ?>
        <br><br>
        <a href="#">Like</a> . <a href="#">Comment</a> .
        <span>
            <?php echo $row['date']; ?>
        </span>

        <span style="float:right">
            Edit . Delete
        </span>
    </div>
</div>