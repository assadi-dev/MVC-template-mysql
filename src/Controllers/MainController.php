<?php
namespace App\Controllers;

class MainController extends AbstractController{
    public function index()  {
        
       $this->render("main/index.html.twig",[]);
      
    }
}