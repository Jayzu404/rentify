<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';
class AuthModel extends DbConnection {
  public function createUser($firstName, $middleName, $lastName, $address, $email, $hashedPassword){
    $query = "INSERT INTO users (first_name, middle_name, last_name, address, email, password)
              VALUES (:firstName, :middleName, :lastName, :address, :email, :hashedPassword)";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      return $stmt->execute([':firstName' => $firstName,
                             ':middleName' => $middleName,
                             ':lastName' => $lastName,
                             ':address' => $address,
                             ':email' => $email,
                             ':hashedPassword' => $hashedPassword]);               
    }catch(PDOException $e){
      echo 'Create Query Error: ' . $e->getMessage();
      return false;
    }  
  }
}