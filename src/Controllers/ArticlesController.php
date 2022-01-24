<?php

namespace App\Controllers;

use App\Models\Articles;




class ArticlesController extends AbstractController
{
   
    public function index()
    {
       
        $model = new Articles();
        $articles = $model->findAll();
        
      
        $this->render("articles/index.html.twig",["articles"=>$articles]);
    }

    public function create()
    {
        $model = new Articles();
        $articles = $model->setTitre('Apprendre le Java')
                    ->setDescription("Descriptions")
                    ->setActif(true);
        $model->create( $articles);            
        echo "create Article";
    }

    public function read(int $id)
    {
        $model = new Articles();
        $article = $model->findByID($id);     
       // var_dump($article);
       $this->httpSend($article);
    }


}