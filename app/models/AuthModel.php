<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';
// class AuthModel extends DbConnection {
//   public function createUser($firstName, $middleName, $lastName, $address, $email, $idPath, $hashedPassword){
//     $query = "INSERT INTO users (first_name, middle_name, last_name, address, email, id_path, password, created_at)
//               VALUES (:firstName, :middleName, :lastName, :address, :email, :id_path, :hashedPassword, NOW())";

//     try {
//       $db = $this->connect();
//       $stmt = $db->prepare($query);

//       $executionStatus = $stmt->execute([
//         ':firstName' => $firstName,
//         ':middleName' => $middleName,
//         ':lastName' => $lastName,
//         ':address' => $address,
//         ':email' => $email,
//         ':id_path' => $idPath,
//         ':hashedPassword' => $hashedPassword],
//       );  

//       //checks if sql execution is success and the data is inserted
//       if($executionStatus && $stmt->rowCount() > 0){
//         $userId = $db->lastInsertId();
//         return ['status' => 'success', 'userId' => $userId];
//       }           
      
      
//     }catch(PDOException $e){
//       echo 'Create Query Error: ' . $e->getMessage();
//       return false;
//     }  
//   }
// }

class AuthModel extends DbConnection {
    
    /**
     * Create a new user account
     * 
     * @return array ['success' => bool, 'userId' => int|null, 'error' => string|null]
     */
    public function createUser($firstName, $middleName, $lastName, $address, $email, $idPath, $hashedPassword) {
        
        // Pre-check for duplicate email (prevents race conditions)
        if ($this->emailExists($email)) {
            return [
                'success' => false,
                'userId' => null,
                'error' => 'EMAIL_EXISTS'
            ];
        }

        $query = "INSERT INTO users (first_name, middle_name, last_name, address, email, id_path, password, created_at)
                  VALUES (:firstName, :middleName, :lastName, :address, :email, :idPath, :hashedPassword, NOW())";

        try {
            $db = $this->connect();
            $stmt = $db->prepare($query);
            
            $stmt->execute([
                ':firstName' => $firstName,
                ':middleName' => $middleName,
                ':lastName' => $lastName,
                ':address' => $address,
                ':email' => $email,
                ':idPath' => $idPath,
                ':hashedPassword' => $hashedPassword
            ]);

            // Verify rows were actually inserted
            if ($stmt->rowCount() > 0) {
                $userId = (int)$db->lastInsertId();
                
                if ($userId > 0) {
                    return [
                        'success' => true,
                        'userId' => $userId,
                        'error' => null
                    ];
                }
            }
            
            // Should rarely happen - log for investigation
            error_log('User creation: Execute succeeded but no rows inserted or no ID generated');
            return [
              'success' => false,
              'userId' => null,
              'error' => 'INSERT_FAILED'
            ];

        } catch (PDOException $e) {
            // Log error with context (check your error_log location: php.ini error_log setting)
            error_log('Database error in createUser: ' . $e->getMessage() . ' | Email: ' . $email);
            
            // Check for duplicate entry (MySQL error code 23000)
            if ($e->getCode() == 23000) {
                return [
                    'success' => false,
                    'userId' => null,
                    'error' => 'DUPLICATE_ENTRY'
                ];
            }
            
            // Generic database error (don't expose details to user)
            return [
                'success' => false,
                'userId' => null,
                'error' => 'DATABASE_ERROR'
            ];
        }
    }

    /**
     * Check if email already exists in database
     * 
     * @param string $email
     * @return bool
     */
    private function emailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        
        try {
            $db = $this->connect();
            $stmt = $db->prepare($query);
            $stmt->execute([':email' => $email]);
            
            return $stmt->fetchColumn() > 0;
            
        } catch (PDOException $e) {
            error_log('Email check error: ' . $e->getMessage());
            // On error, return true to prevent potential duplicates
            return true;
        }
    }
}