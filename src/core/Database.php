<?php 

namespace App\Core;

use PDO;
use PDOException;

class Database extends PDO
{
    private static $instance;

   
    private function __construct()
    {
        // DSN de connexion
        $_dsn = 'mysql:dbname='.$_ENV['DBNAME'].';host='.$_ENV['HOST'];

       
        try{
            parent::__construct($_dsn, $_ENV['USER'], $_ENV['PASS']);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }


}