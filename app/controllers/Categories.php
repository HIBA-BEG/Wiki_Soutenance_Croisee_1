<?php
class categories extends Controller
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
        'CategoryName' => trim($_POST['CategoryName']),
        'CategoryName_err' => ''
      ];

      // Validate data
      if (empty(trim($data['CategoryName']))) {
        $data['CategoryName_err'] = 'Please enter a Category Name';
      }

      // Make sure no errors
      if (empty(trim($data['CategoryName_err']))) {
        // Validated
        if ($this->categoryModel->addCategory($data)) {
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
        'CategoryName' => ''
      ];

      $this->view('Users/dashboard', $data);
    }
  }

  public function show($id)
  {
    $categories = $this->categoryModel->getCategoryById($id);
    $user = $this->categoryModel->getCategoryById($categories['user_id']);

    $data = [
      'categories' => $categories,
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
        'CategoryID' => $id,
        'CategoryName' => trim($_POST['CategoryName']),
        'CategoryName_err' => ''
      ];

      // Validate data
      if (empty(trim($data['CategoryName']))) {
        $data['CategoryName_err'] = 'Please enter a Category Name';
      }

      // Make sure no errors
      if (empty(trim($data['CategoryName_err']))) {
        // Validated
        if ($this->categoryModel->editCategory($data)) {
          redirect('Users/dashboard');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('Users/dashboard', $data);
      }
    } else {
      $categories = $this->categoryModel->getCategoryById($id);
      $user = $this->categoryModel->getCategoryById($categories['user_id']);

      $data = [
        'CategoryID' => $id,
        'Title' => $categories['Title'],
        'Content' => $categories['Content'],
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => trim($_POST['CategoryID'])
      ];

      $this->view('Users/dashboard', $data);
    }
  }



  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // Get existing post from model
      $categories = $this->categoryModel->getCategoryById($id);

      // Check for owner
      if ($categories->user_id != $_SESSION['user_id']) {
        redirect('Users');
      }

      if ($this->categoryModel->deleteCategory($id)) {
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
