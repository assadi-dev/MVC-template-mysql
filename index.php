<?php

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
require_once(ROOT.'/vendor/autoload.php');
require_once(ROOT.'src/Models/Model.php');
require_once(ROOT.'src/Controllers/AbstractController.php');

/**Load .env files */
$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();
$params = explode('/', $_GET["p"]);

if($params[0] !== ""){
    $controller = ucfirst($params[0]."Controller");
    $action = isset($params[1]) ? $params[1] :"index";
    require_once(ROOT.'src/Controllers/'.$controller.".php");
    $controller = new $controller();
    if(method_exists($controller,$action)){
       // $controller->$action();
        unset($params[0]);
        unset($params[1]);
        call_user_func([$controller,$action],$params);       
    }else{
        http_response_code(404);
        echo "la page demander n'existe pas !";
    }   
}else{

    require_once(ROOT.'src/Controllers/MainController.php');
    $controller = new MainController();
    $controller->index();

}