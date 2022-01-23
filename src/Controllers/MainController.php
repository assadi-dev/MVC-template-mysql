<?php

class MainController extends AbstractController{
    public function index()  {
        
      
       $this->render("main/index.html.twig",[]);
      
    }
}