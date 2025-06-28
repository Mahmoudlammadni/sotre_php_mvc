<?php 
class User{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }
    public function all_users(){
        $all = $this->pdo->prepare("select users.* , roles.name as role_name from users inner join roles on 
        users.role_id=roles.id");
        $all->execute(); 
        return $all->fetchAll(PDO::FETCH_ASSOC);   
    }
    
}