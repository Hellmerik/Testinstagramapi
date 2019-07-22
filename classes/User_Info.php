<?php

class User_Info{
    public $username_id;
    public $username;
    public $full_name;

    public function __construct($username_id, $username, $full_name) {
        $this->username_id = $username_id;
        $this->username = $username;
        $this->full_name = $full_name;
    }

    public function __destruct(){
        // TODO: Implement __destruct() method.
    }
}