<?php
namespace App\Models;


use App\Core\Database;

 abstract class Model extends Database {

    
    public $table;
    private $db;
    

 
    public function requete(string $sql,array $attributs = null){
        $this->db = Database::getInstance();

        if($attributs !== null){
            // prepare query
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            // Simple query
            return $this->db->query($sql);
        }
    

    }

    public function createTable (){
        $sql = "CREATE TABLE IF NO EXISTS ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function findAll(){
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();

    }

    public function findByID(int $id){
        $sql = "SELECT * FROM ".$this->table." WHERE id=".$id." LIMIT 0,1";
        return $this->requete($sql)->fetch();
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
        $sql = "SELECT * FROM {$this->table} WHERE {$fielList}";
        return $this->requete($sql,$values)->fetchAll();


    }

    public function create(Model $model){

        $fields = [];
        $inter = [];
        $values = [];

        foreach ($model as $key => $value) {
            if($value != null && $key != "db" && $key != "table")
            {
                $fields[]="$key";
                $inter[] = "?";
                $values[]=$value;
            }

        }
       
        //table to string
        $fielList = implode(" , ",$fields);
        $interList = implode(" , ",$inter);

        //Execute query
        $sql = "INSERT INTO {$this->table} ({$fielList}) VALUES ({$interList})";
        return $this->requete($sql,$values);

    }

    public function hydrate(array $data){
        foreach ($data as $key => $value){
            //get setter correspond key
            $setter = "set".ucfirst("$key");
            // verify if setter exists
            if(method_exists($this,$setter)){
                $this->$setter($value);
            }
        }
        return $this;
    }


 }