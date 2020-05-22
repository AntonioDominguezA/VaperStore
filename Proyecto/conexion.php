<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'vaper';
    $port = '3308';

    try {
      $conn = new PDO("mysql:host=$server;port=$port;dbname=$database;",$username,$password);
    } catch (PDOException $e) {
      die('Connection failed: '.$e->getMessage());
    }

?>
