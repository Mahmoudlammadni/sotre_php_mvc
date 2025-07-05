<?php 
class Client{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }
     public function all_clients(){
        $all = $this->pdo->prepare("SELECT clients.* , users.* from users INNER JOIN clients on clients.user_id= users.id");
        $all->execute(); 
        return $all->fetchAll(PDO::FETCH_ASSOC);   
    }
    public function getClientById($id){
        $user = $this->pdo->prepare("SELECT clients.* , users.* from users INNER JOIN clients on clients.user_id=users.id where users.id =:id");
        $user->execute([
            'id'=>$id
        ]);
        return $user->fetch(PDO::FETCH_ASSOC);
    }
}
 