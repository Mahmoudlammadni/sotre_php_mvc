<?php
include __DIR__ . '/../model/User.php';
class UserController{
    private  $model;
    public function __construct()
    {
        global $pdo;
        $this->model= new user($pdo);
    }

    public function index(){
        $users=$this->model->all_users();
        include __DIR__ . '/../view/users/index.php';

    }
}

