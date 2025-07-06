<?php 
class Client {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all_clients() {
        $stmt = $this->pdo->prepare("
            SELECT clients.id AS client_id, clients.phone, clients.address,
                   users.id AS user_id, users.username, users.email,users.password, users.created_at
            FROM clients
            INNER JOIN users ON clients.user_id = users.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientByUserId($id) {
        $stmt = $this->pdo->prepare("
            SELECT clients.*, users.username, users.email ,users.password
            FROM clients
            INNER JOIN users ON clients.user_id = users.id
            WHERE clients.user_id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function StoreClient($name, $email, $password, $phone, $address) {
        try {
            $this->pdo->beginTransaction();
            $roleStmt =$this->pdo->prepare("SELECT roles.id from roles where name =:name");
            $roleStmt->execute([
                "name"=>'client'
            ]);
            $role = $roleStmt->fetch(PDO::FETCH_ASSOC);
            if (!$role) {
            throw new Exception("Client role not found");
        }
            $stmt1 = $this->pdo->prepare("INSERT INTO users (username, email, password, role_id)
                                          VALUES (:name, :email, :password, :role_id)
            ");
            $stmt1->execute([
                'name' => $name, 
                'email' => $email,
                'password' => $password,
                'role_id' => $role['id']
            ]);

            $user_id = $this->pdo->lastInsertId();
            $stmt2 = $this->pdo->prepare("INSERT INTO clients (name, email, phone, address, user_id)
                                         VALUES (:name, :email, :phone, :address, :user_id)
            ");
            $stmt2->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'user_id' => $user_id
            ]);
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function UpdateClient($id, $name, $email, $password, $phone, $address) {
        try {
            $this->pdo->beginTransaction();
            $stmt1 = $this->pdo->prepare(" UPDATE users SET username = :name, email = :email, password =
                                          :password WHERE id = :id
            ");
            $stmt1->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'id' => $id
            ]);

            $stmt2 = $this->pdo->prepare("UPDATE clients SET name = :name, email = :email, phone = :phone, 
                                        address = :address WHERE user_id = :id
            ");
            $stmt2->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'id' => $id
            ]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
