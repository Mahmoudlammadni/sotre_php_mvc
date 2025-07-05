<?php 
class User{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }
    public function all_users(){
        $all = $this->pdo->prepare("SELECT users.*, roles.name as role_name 
                                FROM users INNER JOIN roles ON users.role_id = roles.id 
                                WHERE roles.name = :role1 OR roles.name = :role2");
                               
        $all->execute([
           "role1"=>"admin",
           "role2"=>"manager"
        ]); 
        return $all->fetchAll(PDO::FETCH_ASSOC);   
    }
    public function getUserById($id){
        $req = $this->pdo->prepare("SELECT * from  users where id=:id ");
        $req->execute([
            'id'=>$id
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function LogIn($email,$password){
        $req = $this->pdo->prepare("select users.* , roles.name as role_name from users inner join roles on users.role_id = roles.id
         where users.email=:email and users.password=:password");
        $req->execute([
            'email'=>$email ,
            "password"=>$password
        ]);
        $user=$req->fetch(PDO::FETCH_ASSOC);
        if($user){
            return $user ;
        }
        return false ; 
    }
    
    public function StoreUser($name,$email,$password,$role){
        try{
        $req=$this->pdo->prepare("INSERT INTO `users`(`username`, `email`, `password`, `role_id`) VALUE (:name,:email,:password,:role_id)");
        $req->execute(["name"=>$name,"email"=>$email,"password"=>$password,"role_id"=>$role]);
        }catch(PDOException $e){
         echo 'Failed'.$e->getMessage();
        }
    }
    

    public function UpdateUser($id,$name,$email,$password,$role_id){
        try{
            $req=$this->pdo->prepare("UPDATE `users` SET username =:name,email=:email,password=:password,role_id=:role_id where id =:id");
            $req->execute([
                "name"=>$name,
                "email"=>$email,
                "password"=>$password,
                "role_id"=>$role_id,
                "id"=>$id
            ]);
        }catch(PDOException $e){
            echo "Failed".$e->getMessage();
        }

    }


public function destroy($id){
    $req = $this->pdo->prepare("SELECT * from users where id= :id ");
    $req->execute([
        "id"=>$id
    ]);
    $user= $req->fetch(PDO::FETCH_ASSOC);
    if($user){
            try{
                $req2=$this->pdo->prepare("DELETE from users where id =:id");
                $req2->execute([
                    "id"=>$id
                ]);
            }
            catch(PDOException $e){
                echo 'Error'.$e->getMessage();
            }
    }
}

}