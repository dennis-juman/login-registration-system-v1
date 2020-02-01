<?php
class database_connection{
    private $db_username = 'unaux_24749996';
    private $db_password = '79lueulug2s';

    function connect(){
        try {
            $db_host = new PDO('mysql:host=sql113.unaux.com;dbname=unaux_24749996_cameradesuyo', $this->db_username, $this->db_password);
        } catch (PDOException $e) {
            echo "<h1>Error: " . $e->getMessage() . "</h1>";
            die();
        }
        return $db_host;
    }
}

