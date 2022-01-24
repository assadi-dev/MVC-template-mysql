<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController{
    
    private $loader;
    protected $twig;

    public function __construct(){
        $this->loader = new FilesystemLoader(ROOT.'templates');
        $this->twig = new Environment($this->loader);
    }
    
    public function httpSend($params){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');   
        echo json_encode($params,JSON_UNESCAPED_UNICODE);
    }
   
    public function render (string $path,array $options){

        $this->twig->display($path,$options);
    }
}