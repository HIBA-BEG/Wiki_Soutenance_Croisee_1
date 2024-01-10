<?php
class categories extends Controller
{
  private $categoryModel;
  private $userModel;

  public function __construct()
  {
    if (!isset($_SESSION['id_user'])) {
      redirect('users/login');
    }

    $this->categoryModel = $this->model('Category');
    $this->userModel = $this->model('User');
  }


//   public function index()
//   {
//     $categories = $this->categoryModel->getCategory();
//     $data = [
//       'categories' => $categories,
//     ];

//     $this->view('categories/index', $data);
//   }


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
        if ($this->categoryModel->addCategory($data)) {
          flash('category_message', 'Category Added');
          redirect('categories');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('categories/add', $data);
      }
    } else {
      $data = [
        'Title' => '',
        'Content' => '',
        'creation_date' => date('Y-m-d'),
        'CategoryID_err' => ''
      ];

      $this->view('categories/add', $data);
    }
  }

  public function show($id){
    $categories = $this->categoryModel->getCategoryById($id);
    $user = $this->categoryModel->getCategoryById($categories['user_id']);

    $data = [
      'categories' => $categories,
      'user' => $user
    ];

    $this->view('categories/show', $data);
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
        if ($this->categoryModel->editCategory($data)) {
          flash('category_message', 'Category edited');
          redirect('categories');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('categories/edit', $data);
      }
    } else {
      $categories = $this->categoryModel->getCategoryById($id);
      $user = $this->categoryModel->getCategoryById($categories['user_id']);

      $data = [
        'WikiID' => $id,
        'Title' => $categories['Title'],
        'Content' => $categories['Content'],
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => trim($_POST['CategoryID'])
      ];

      $this->view('categories/edit', $data);
    }
  }



    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // Get existing post from model
        $categories = $this->categoryModel->getCategoryById($id);

        // Check for owner
        if($categories->user_id != $_SESSION['user_id']){
          redirect('categories');
        }

        if($this->categoryModel->deleteCategory($id)){
          flash('post_message', 'Category Removed');
          redirect('categories');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('categories');
      }
    }
}
