<?php

class DbConnection {
  private $host = 'localhost';
  private $user = 'root';
  private $dbName = 'rental_system';
  private $password = '';

  protected function connect(){
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
      return new PDO($dsn, $this->user, $this->password);
    } catch (PDOException $e){
      error_log('Connection error: ' . $e->getMessage());
    }
  }
}