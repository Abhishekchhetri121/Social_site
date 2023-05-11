<?php

class User
{
    public function get_data($id)
    {
        $db = new database();
        $query = "SELECT * FROM USERS WHERE userid = '$id' LIMIT 1";
        $result = $db->read($query);


        if ($result) {

            $row = $result[0];
            return $row;
        } else {
            return false;
        }
    }

    public function get_user($id)
    {
        $db = new database();
        $query = "SELECT * FROM USERS WHERE userid = '$id' LIMIT 1";
        $result = $db->read($query);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function get_friends($fid)
    {
        $db = new database();
        $query = "SELECT * FROM USERS WHERE userid != '$fid'";
        $result = $db->read($query);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}
