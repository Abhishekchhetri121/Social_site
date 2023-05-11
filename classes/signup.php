<?php

class SignUp
{
    private $error = ""; //used for returning error
    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            # code...
            if (empty($value)) {
                $this->error = $this->error .  $key . " is empty!<br>";
            }
            //email validation check
            if ($key == "email") {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error = $this->error .  $key . "Invalid email address!<br>";
                }
            }

            //name numeric or not
            if ($key == "first_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error .  $key . "first_name cannot be number!<br>";
                }

                if (strstr($value, " ")) {
                    $this->error = $this->error .  $key . "first_name cannot have space!<br>";
                }
            }

            if ($key == "last_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error .  $key . "last_name cannot be number!<br>";
                }

                if (strstr($value, " ")) {
                    $this->error = $this->error .  $key . "last_name cannot have space!<br>";
                }
            }
        }
        if ($this->error == "") {
            //no error
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }
    public function create_user($data)
    {

        //ucfirst makes firt letter capital 
        $first_name = ucfirst($data["first_name"]);
        $last_name = ucfirst($data["last_name"]);
        $gender = $data["gender"];
        $email = $data["email"];
        $password = $data["password"];

        //creste these
        $url_address = strtoLower($first_name) . "." . strtoLower($last_name);
        $userid = $this->create_userid();

        $query = "INSERT INTO USERS (userid,first_name,last_name,gender,email,password,url_address) VALUES('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";

        //echo $query;
        $db = new database();
        $db->save($query);
    }



    private function create_userid()
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
}
