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
    public function UpdateCategory($id,$name,$des){
        try{
            $req=$this->pdo->prepare("UPDATE `categories` SET name=:name,description=:description where id =:id");
            $req->execute([
                "name"=>$name,
                "description"=>$des,
                "id"=>$id
            ]);
        }catch(PDOException $e){
            echo "Filed". $e->getMessage();
        }
    }
    public function destroy($id){
        try{
            $stmt=$this->pdo->prepare("DELETE FROM `categories` where id=:id");
            $stmt->execute([
                "id"=>$id
            ]);
        }catch(PDOException $e){
            echo "Failed".$e->getMessage();
        }
    }
}