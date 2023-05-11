<?php

class POST
{

    private $error = "";
    public function create_post($userid, $data, $files)
    {
        $image_class = new Image();
        if (
            !empty($data['post']) || !empty($files['file']['name']) ||
            isset($data['is_profile']) || isset($data['is_cover'])
        ) {

            $myimage = "";
            $has_image = 0;
            $is_cover = 0;
            $is_profile = 0;
            if (isset($data['is_profile']) || isset($data['is_cover'])) {
                $myimage = $files;
                $has_image = 1;
                if (isset($data['is_cover'])) {
                    $is_cover = 1;
                }
                if (isset($data['is_profile'])) {
                    $is_profile = 1;
                }
            } else {
                //from
                if (!empty($files['file']['name'])) {


                    $folder = "uploads/" . $userid . "/";
                    //$filename = "uploads/" . $_FILES['file']['name'];

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true); //making of folder true b/c if     uploads doesn't exists then creates
                    }


                    $myimage = $folder . $image_class->generate_filename(15) . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $myimage);

                    $image_class->resize_image($myimage, $myimage, 1500, 1500);



                    $has_image = 1;
                }
            }


            //till here

            $post = "";
            if (isset($data['post'])) {
                $post = addslashes($data['post']);
            }
            $postid = $this->create_postid();

            $query = "INSERT INTO posts (postid,userid,post,image,has_image,is_profile,is_cover) VALUES('$userid','$postid','$post','$myimage','$has_image','$is_cover','$is_profile')";
            $db = new database();
            $db->save($query);
        } else {

            $this->error .= "Please type else to post!!<br>";
        }
        return $this->error;
    }

    private function create_postid()
    {

        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {

            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
            # code...
        }
        return $number;
    }

    public function get_posts($id)
    {

        $query = "SELECT * FROM posts WHERE postid = '$id' ORDER BY id DESC LIMIT 10";
        $db = new database();
        $result = $db->read($query);

        if ($result) {

            return $result;
        } else {
            return false;
        }
    }
}
