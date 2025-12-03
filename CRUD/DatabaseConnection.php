<?php

class DatabaseConnection
{
    protected $db_host;
    protected $db_username;
    protected $db_password;
    protected $db_databasename;
    protected $db_port;
    protected $db_socket;
    protected $pdo;

    function __construct()
    {
        $this->db_host = 'localhost';
        $this->db_username = 'test';
        $this->db_password = '';
        $this->db_databasename = 'testing_oop';
        $this->db_port = 8888;
        $this->db_socket = '/Applications/MAMP/tmp/mysql/mysql.sock';
        $this->db_connect();
    }

    private function db_connect()
    {
        try {
            $dsn = "mysql:host={$this->db_host};port={$this->db_port};dbname={$this->db_databasename};unix_socket={$this->db_socket}";
            $this->pdo = new PDO($dsn, $this->db_username, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Connection Failed: ' . $e->getMessage());
        }
    }

    private function executeStatement($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Failed to execute statement: " . $e->getMessage());
        }
    }

    function selectData($db_table, $column)
    {
        $query = "SELECT * FROM $db_table ORDER BY $column";
        return $this->executeStatement($query);
    }

    function selectSingleRecord($db_table, $field, $value)
    {
        $query = "SELECT * FROM $db_table WHERE $field = ?";
        $params = [$value];

        return $this->executeStatement($query, $params);
    }

    function updateClientData($companyName, $contactPerson, $phone, $address, $companyId)
    {
        $query = "UPDATE clients SET company_name = ?, contact_person = ?, phone = ?, address = ? WHERE company_id = ?";
        $params = [$companyName, $contactPerson, $phone, $address, $companyId];

        $this->executeStatement($query, $params);

        return "Data Updated";
    }

    public function insertClientData($companyName, $contactPerson, $phone, $address, $createdById)
    {
        $query = "INSERT INTO clients (company_name, contact_person, phone, address, created_by) VALUES (?, ?, ?, ?, ?)";
        $params = [$companyName, $contactPerson, $phone, $address, $createdById];

        $this->executeStatement($query, $params);

        return "Data Inserted";
    }

    public function insertUserData($name, $email, $password)
    {
        try {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $params = [$name, $email, $hashedPassword];

            $this->executeStatement($query, $params);

            return "Data Inserted";
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteData($table, $column, $value, $createdByColumn, $createdByValue)
    {
        $query = "DELETE FROM $table WHERE $column = ? AND $createdByColumn = ?";
        $params = [$value, $createdByValue];

        $this->executeStatement($query, $params);

        return "Data Deleted";
    }

    function checkLoginWithEmail($email, $password)
    {
        $query = "SELECT user_id, name, email, password FROM users WHERE email = ?";
        $params = [$email];

        try {
            $result = $this->executeStatement($query, $params);

            if (isset($result[0])) {
                $user = $result[0];

                // Verify the entered password against the hashed password
                if (password_verify($password, $user['password'])) {
                    // Password is correct

                    // Include user ID in the returned user data
                    $user['user_id'] = $user['user_id'];

                    // Return the user data
                    return $user;
                } else {
                    // Password is incorrect
                    return "Incorrect password";
                }
            } else {
                // No user found with the given email
                return "User not found";
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getClientData($companyId)
    {
        $query = "SELECT * FROM clients WHERE company_id = ?";
        $params = [$companyId];

        $result = $this->executeStatement($query, $params);

        return isset($result[0]) ? $result[0] : null;
    }
}
