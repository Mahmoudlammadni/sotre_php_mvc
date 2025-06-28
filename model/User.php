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

    public function LogIn($email,$password){
        $req = $this->pdo->prepare("select users.* , roles.name as role_name from users inner join roles on users.role_id = roles.id
         where users.email=:email and users.password=:password");
        $req->execute(['email'=>$email ,"password"=>$password]);
        $user=$req->fetch(PDO::FETCH_ASSOC);
        if($user){
            return $user ;
        }
        return false ;
        
    }
}