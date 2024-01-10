<?php
class Wikis extends Controller
{
  private $wikiModel;
  private $userModel;

  public function __construct()
  {
    if (!isset($_SESSION['id_user'])) {
      redirect('users/login');
    }

    $this->wikiModel = $this->model('Wiki');
    $this->userModel = $this->model('User');
  }


  public function index()
  {
    $wikis = $this->wikiModel->getWiki();
    $data = [
      'wikis' => $wikis,
    ];

    $this->view('wikis/index', $data);
  }


  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'AuthorID' => $_SESSION['user_id'],
        'Title' => trim($_POST['Title']),
        'Content' => trim($_POST['Content']),
        'Creation_date' => date('Y-m-d'), // current timestamp
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => trim($_POST['CategoryID']),
        'Title_err' => '',
        'Content_err' => '',
        'CategoryID_err' => ''
      ];

      // Validate data
      if (empty(trim($data['Title']))) {
        $data['Title_err'] = 'Please enter a title';
      }
      if (empty(trim($data['Content']))) {
        $data['Content_err'] = 'Please enter a Content';
      }
      if (empty($data['CategoryID'])) {
        $data['CategoryID_err'] = 'Please enter a category';
      }

      // Make sure no errors
      if (empty(trim($data['Title_err'])) && empty(trim($data['Content_err'])) && empty(trim($data['CategoryID_err']))) {
        // Validated
        if ($this->wikiModel->addWiki($data)) {
          flash('wiki_message', 'Wiki Added');
          redirect('wikis');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('wikis/add', $data);
      }
    } else {
      $data = [
        'Title' => '',
        'Content' => '',
        'creation_date' => date('Y-m-d'),
        'CategoryID_err' => ''
      ];

      $this->view('wikis/add', $data);
    }
  }

  public function show($id){
    $wikis = $this->wikiModel->getWikiById($id);
    $user = $this->wikiModel->getWikiById($wikis['user_id']);

    $data = [
      'wikis' => $wikis,
      'user' => $user
    ];

    $this->view('wikis/index', $data);
  }

  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // 'user_id' => '',
        'WikiID' => $id,
        'Title' => trim($_POST['Title']),
        'Content' => trim($_POST['Content']),
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => trim($_POST['CategoryID']),
        'Title_err' => '',
        'Content_err' => ''
      ];

      // Validate data
      if (empty(trim($data['Title']))) {
        $data['Title_err'] = 'Please enter a title';
      }
      if (empty(trim($data['Content']))) {
        $data['Content_err'] = 'Please enter a Content';
      }
      if (empty($data['CategoryID'])) {
        $data['CategoryID_err'] = 'Please enter a date';
      }

      // Make sure no errors
      if (empty(trim($data['Title_err'])) && empty(trim($data['Content_err'])) && empty(trim($data['CategoryID_err']))) {
        // Validated
        if ($this->wikiModel->editWiki($data)) {
          flash('wiki_message', 'Wiki edited');
          redirect('wikis');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('wikis/edit', $data);
      }
    } else {
      $wikis = $this->wikiModel->getWikiById($id);
      $user = $this->wikiModel->getWikiById($wikis['user_id']);

      $data = [
        'WikiID' => $id,
        'Title' => $wikis['Title'],
        'Content' => $wikis['Content'],
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => trim($_POST['CategoryID'])
      ];

      $this->view('wikis/edit', $data);
    }
  }



    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // Get existing post from model
        $wikis = $this->wikiModel->getWikiById($id);

        // Check for owner
        if($wikis->user_id != $_SESSION['user_id']){
          redirect('wikis');
        }

        if($this->wikiModel->deleteWiki($id)){
          flash('post_message', 'Wiki Removed');
          redirect('wikis');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('wikis');
      }
    }
}
