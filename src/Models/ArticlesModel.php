<?php

class ArticlesModel extends Model 
{
    public function __construct() {
        $this->table = "articles";
        $this->getConnexion();
    }

}