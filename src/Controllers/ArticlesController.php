<?php

class ArticlesController extends AbstractController
{
    public function index()
    {
        $this->loadModel("ArticlesModel");
        $this->render("articles/index.html.twig",["hello"=>"Hello world"]);
    }
}