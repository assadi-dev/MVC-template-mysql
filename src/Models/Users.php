<?php

namespace App\Models;



class Users extends Model 
{
    protected $id;
    protected $username;
    protected $password;
    protected $createdAt;
    protected $updatedAt;
    protected $role;



    public function __construct() {

       
        $this->table = "users";
        
    }

}