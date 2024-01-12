<?php
  class Visitors extends Controller {

    private $wikiModel;
    public function __construct(){
      $this->wikiModel = $this->model('Wiki');
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('Wikis');
      }

      $wikis = $this->wikiModel->getWiki();
    $data = [
      'wikis' => $wikis,
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