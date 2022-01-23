<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController{
    
    private $loader;
    protected $twig;

    public function __construct(){
        $this->loader = new FilesystemLoader(ROOT.'templates');
        $this->twig = new Environment($this->loader);
    }
    
    public function loadModel(string $model){
        require_once(ROOT."src/Models/".$model.".php");
        $this->$model = new $model();
    }

   
    public function render (string $path,array $options){

        $this->twig->display($path,$options);
    }
}