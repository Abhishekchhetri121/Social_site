<?php
class Login
{
    private $error = "";

    public function evaluate($data)
    {

        $email = addslashes($data["email"]); //addslashes escapes certain strings eg: 'jon\'s data' 
        $password = addslashes($data["password"]);



        $query = "SELECT * FROM USERS WHERE email = '$email' limit 1";

        //echo $query;
        $log = new Login();
        $db = new database();
        $result =  $db->read($query);

        if ($result) {


            $row =  $result[0];

            if ($password == $row['password']) {

                //session creation
                $_SESSION['SOCIAL_userid'] = $row['userid'];
            } else {
                $this->error .= "wrong password<br>";
            }
        } else {
            $this->error .= "No such email was found<br>";
        }

        return $this->error;
    }

    public function check_login($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM USERS WHERE userid = '$id' limit 1";

            //echo $query;

            $db = new database();
            $result =  $db->read($query);

            if ($result) {
                $user_data = $result[0];
                return $user_data;
            } else {
                header("Location:login.php");
                die();
            }
        } else {
            header("Location:login.php");
            die();
        }
    }
}
