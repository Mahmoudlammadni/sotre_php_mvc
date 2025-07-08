<?php 
class Category {
    private $pdo ; 
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
     public function getAll() {
        $stmt = $this->pdo->query(" SELECT * from categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function StoreCategory($name,$des){
        try{
            $req=$this->pdo->prepare("INSERT INTO `categories`( name, description)
                                      VALUES( :name, :description )");
            $req->execute([
                "name"=>$name,
                "description"=>$des
            ]);
        }catch(PDOException $e){
            echo "Faild".$e->getMessage();

        }
    }
}