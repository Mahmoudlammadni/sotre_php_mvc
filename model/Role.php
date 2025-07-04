<?php 
class Role {
    private $pdo;
    public function __construct($pdo){
       $this->pdo=$pdo; 
    }
    public function getRoles(){
        $req = $this->pdo->query("SELECT * FROM roles");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}


 