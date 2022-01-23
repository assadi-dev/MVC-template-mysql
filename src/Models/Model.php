<?php


 abstract class Model {

    protected $_connexion;

    public $table;
    public $id;
    
  


    public function getConnexion(){
        var_dump($this->host);
        $this->_connexion = null;
        try{
            $this->_connexion = new PDO("mysql:host=".$_ENV['HOST'], $_ENV['USER'], $_ENV['PASS']);
            $sql = "CREATE DATABASE IF NOT EXISTS `".$_ENV['DBNAME']."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
            $this->_connexion->prepare($sql)->execute();
        }catch(PDOException $exception){
            echo "Erreur de connexion : ".$exception->getMessage();
        }


    }

    public function createTable (){
        $sql = "CREATE TABLE IF NO EXISTS ".$this->table;

    }

    public function findAll(){
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();   

    }

    public function findByID(){
        $sql = "SELECT * FROM ".$this->table." WHERE id=".$this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function findBy(array $options){
        $fields = [];
        $values = [];

        foreach ($options as $key => $value) {
            $fields[]="$key = ?";
            $values[]=$value;
        }

        //table to string
        $fielList = implode(" AND ",$fields);

        //Execute query
        $sql = "SELECT * FROM {$this->table} WHERE {$this->$fielList}";
        $query = $this->_connexion->prepare($sql);
        $query->execute($options);
        return $query->fetchAll();   


    }


 }