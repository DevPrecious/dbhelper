<?php

namespace app\src;

class DBConnect {

    public $connect;

    public function __construct(array $dbcredentials)
    {
        extract($dbcredentials);

        $this->connect = mysqli_connect($localhost, $username, $password, $db);
        if(!$this->connect){
            die('Error connecting to'.' database : '.$db);
        }

         
    }

    public function separate(array $dbcred)
    {
        extract($dbcred);

        return [
            'localhost' => $localhost,
            'username' => $username,
            'password' => $password,
            'db' => $db,
        ];
    }
}