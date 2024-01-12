<?php
class tags extends Controller
{
  private $categoryModel;
  private $userModel;
  private $wikiModel;
  private $tagModel;

  public function __construct()
  {
    if (!isset($_SESSION['id_user'])) {
      redirect('users/login');
    }

    $this->categoryModel = $this->model('Category');
    $this->userModel = $this->model('User');
    $this->wikiModel = $this->model('Wiki');
    $this->tagModel = $this->model('Tag');
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'TagName' => trim($_POST['TagName']),
        'created_id' => $_SESSION['id_user'],
        'TagName_err' => ''
      ];
      

      // Validate data
      if (empty(trim($data['TagName']))) {
        $data['TagName_err'] = 'Please enter a Tag Name';
      }

      // Make sure no errors
      if (empty(trim($data['TagName_err']))) {
        // Validated
        if ($this->tagModel->addTag($data)) {
          redirect('Users/dashboard');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('Users/dashboard', $data);
      }
    } else {
      $data = [
        'TagName' => '',
        'TagID'=>''
      ];

      $this->view('Users/dashboard', $data);
    }
  }

  public function show($id)
  {
    $tags = $this->tagModel->getTagById($id);
    $user = $this->tagModel->getTagById($tags['user_id']);

    $data = [
      'tags' => $tags,
      'user' => $user
    ];

    $this->view('Users/dashboard', $data);
  }

  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // 'user_id' => '',
        'TagID' => $id,
        'TagName' => trim($_POST['TagName']),
        'TagName_err' => ''
      ];
  
      // Validate data
      if (empty(trim($data['TagName']))) {
        $data['TagName_err'] = 'Please enter a Tag Name';
      }

      // Make sure no errors
      if (empty(trim($data['TagName_err']))) {
        // Validated
        if ($this->tagModel->editTag($data)) {
          redirect('Users/dashboard');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('Users/dashboard', $data);
      }
    } else {
      $categories = $this->tagModel->getTagById($id);

      $data = [
        'TagID' => $id,
        'TagName' => $categories['TagName']
      ];

      $this->view('Users/dashboard', $data);
    }
  }



  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // Get existing post from model
      $categories = $this->tagModel->getTagById($id);

      // Check for owner
      if ($categories->user_id != $_SESSION['user_id']) {
        redirect('Users');
      }

      if ($this->tagModel->deleteTag($id)) {
        flash('post_message', 'Category Removed');
        redirect('Users/dashboard');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('Users');
    }
  }
}
