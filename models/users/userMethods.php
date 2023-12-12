<?php

class UserRepository {
    protected $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $newUsername, $newEmail, $role_id) {
        $stmt = $this->connection->prepare("UPDATE users SET username = ?, email = ?, role_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $newUsername, $newEmail, $role_id, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getUserCount() {
        $query = "SELECT COUNT(*) AS user_count FROM users";
        $result = $this->connection->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['user_count'];
        } else {
            return 0; // Return 0 if no users found or in case of an error
        }
    }

    public function getUsers() {
        $query = "SELECT u.id, u.username, u.email, r.role_name AS role
        FROM users u
        LEFT JOIN role r ON u.role_id = r.id";
        $result = $this->connection->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Return an empty array if no users found
        }
    }

    public function linkUserRole($role_id, $user_id) {
        $stmt = $this->connection->prepare("UPDATE users SET role_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $role_id, $user_id);
        return $stmt->execute();
    }

    public function getAllRoles() {
        $query = "SELECT * FROM role"; // Modify this query based on your database schema
        $result = $this->connection->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Return an empty array if no roles found
        }
    }

    public function authenticateUser($email, $password) {
        $stmt = $this->connection->prepare("SELECT id, username, password, role_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                // Passwords match, return user data without password for security
                unset($user['password']);
                return $user;
            }
        }

        return null; // Authentication failed
    }
}
?>
