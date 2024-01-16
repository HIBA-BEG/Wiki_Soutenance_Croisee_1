<?php
  class Visitors extends Controller {

    private $wikiModel;
    private $categoryModel;
    public function __construct(){
      $this->wikiModel = $this->model('Wiki');
      $this->categoryModel = $this->model('Category');
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('Wikis');
      }

      $wikis = $this->wikiModel->getWiki();
      $categories = $this->categoryModel->getCategory();
     
     $wikitag=[];
     foreach( $wikis as $wiki ) {
      $tags = $this->wikiModel->get_tags_wiki($wiki->WikiID);
      
      $wiki->wikitag=$tags;
      $wikitag[]=$wiki;
     }
  
      $data = [
        'wikis' => $wikis,
        'categories' => $categories,
        'Title' => '',
        'Content' => '',
        'CategoryID' => '',
        'creation_date' => date('Y-m-d'),
        'Title_err' => '',
        'Content_err' => '',
        'CategoryID_err' => ''
      ];
      

    $this->view('visitors/index', $data);
    }

    

  }