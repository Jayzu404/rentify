<?php

class DbConnection {
  private $host = 'localhost';
  private $user = 'root';
  private $dbName = 'rental_system';
  private $password = '';

  protected function connect(){
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
      $pdo = new PDO($dsn, $this->user, $this->password);

      // ✅ Recommended settings:
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // throw exceptions on errors
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // always return associative arrays
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // use native prepared statements (safer)

      return $pdo;
      
    } catch (PDOException $e){
      error_log('Connection error: ' . $e->getMessage());
    }
  }
}