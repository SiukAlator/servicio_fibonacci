<?php

class DbConnect {

    private $conn;

    function __construct() {
    }

    function connect() {
        
        include_once dirname(__FILE__) . '/Config.php';
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->conn->set_charset("utf8");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $this->conn;

        // include_once dirname(__FILE__) . '/Config.php';
        // $conn = ssh_connect(DB_HOST_SSH, 22, array('hostkey'=>'ssh-rsa'));
        // $lala = file_get_contents(dirname(__FILE__).'/key_ssh/id_rsa.pub');
        // $lala2 = file_get_contents(dirname(__FILE__).'/key_ssh/id_rsa');
        //
        // if (ssh2_auth_pubkey_file($conn, 'root',
        //                           $lala,
        //                           $lala2, ''))
        // {
        //      $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        //      $this->conn->set_charset("utf8");
        //
        //      if (mysqli_connect_errno()) {
        //          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //      }
        //      return $this->conn;
        // } else {
        //     echo('Public Key Authentication Failed');
        // }
    }

}
