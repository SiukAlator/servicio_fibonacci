<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        include_once dirname(__FILE__) . '/Config.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    
}
?>
