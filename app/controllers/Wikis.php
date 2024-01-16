<?php
class Wikis extends Controller
{
  private $wikiModel;
  private $userModel;
  private $tagModel;
  private $categoryModel;

  public function __construct()
  {
    if (!isset($_SESSION['id_user'])) {
      redirect('users/login');
    }

    $this->wikiModel = $this->model('Wiki');
    $this->userModel = $this->model('User');
    $this->tagModel = $this->model('Tag');
    $this->categoryModel = $this->model('Category');
  }


  public function index()
  {
    $wikis = $this->wikiModel->getWiki();
    $categories = $this->categoryModel->getCategory();
    $tags = $this->tagModel->getTag();

    $data = [
      'wikis' => $wikis,
      'categories' => $categories,
      'tags' => $tags,
      'Title' => '',
      'Content' => '',
      'CategoryID' => '',
      'creation_date' => date('Y-m-d'),
      'Title_err' => '',
      'Content_err' => '',
      'CategoryID_err' => ''
    ];


    $this->view('wikis/index', $data);
  }


  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'AuthorID' => $_SESSION['id_user'],
        'Title' => trim($_POST['Title']),
        'Content' => trim($_POST['Content']),
        'CreationDate' => date('Y-m-d'), // current timestamp
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
        $id_wiki = $this->wikiModel->addWiki($data);
        if ($id_wiki) {
          $encoded_string = $_POST['selected_tag_id'];

          // Decode the JSON string to an array

          $decoded_string = json_decode(html_entity_decode($encoded_string));

          $this->tagModel->add_wiki_tags($id_wiki, $decoded_string);


          redirect('wikis');
        } else {
          die('Something went wrong ');
        }
      } else {
        // Load view with errors

        $this->view('wikis/index', $data);
      }
    } else {
      $data = [
        'Title' => '',
        'Content' => '',
        'CreationDate' => date('Y-m-d'),
        'Title_err' => '',
        'Content_err' => '',
        'CategoryID_err' => ''
      ];

      $this->view('wikis/index', $data);
    }
  }

  public function show($id)
  {
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
        // 'AuthorID' => $_SESSION['id_user'],
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

      // Make sure no errors
      if (empty(trim($data['Title_err'])) && empty(trim($data['Content_err']))) {
        // Validated
        $this->wikiModel->editWiki($id, $data);
        if ($this->tagModel->delete_tags($id)) {
          $selectedTagsString = $_POST['selected_tag_id'];
          // Decode the JSON string to an array
          $decoded_string = json_decode(html_entity_decode($selectedTagsString));
          $this->tagModel->add_wiki_tags($id, $decoded_string);
          redirect('wikis');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('wikis/edit', $data);
      }
    } else {
      $wiki = $this->wikiModel->getWikiById($id);
      // $user = $this->wikiModel->getWikiById($wikis['id_user']);
      $category = $this->categoryModel->getCategoryById($wiki['CategoryID']);
      $tags = $this->tagModel->get_tags_wiki($id);
      $data = [
        'Wiki' => $wiki,
        'category' => $category,
        'tag' => $tags,
        'categories' => $this->categoryModel->getCategory(),
        'tags' => $this->tagModel->getTag(),
        'LastModifiedDate' => date('Y-m-d'), // current timestamp
        'CategoryID' => $wiki['CategoryID'],
        'selected_tags' => '',
        'titre_err' => '',
        'description_err' => ''
      ];

      $this->view('wikis/index', $data);
    }
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // Get existing post from model
      $wikis = $this->wikiModel->getWikiById($id);

      // Check for owner
      if ($wikis->id_user != $_SESSION['id_user']) {
        redirect('wikis');
      }

      if ($this->wikiModel->deleteWiki($id)) {
        flash('post_message', 'Wiki Removed');
        redirect('wikis');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('wikis');
    }
  }

  // public function archivehh($id)
  // {
  //   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  //     // Get existing post from model
  //     $wikis = $this->wikiModel->getWikiById($id);

  //     // Check for owner
  //     if ($wikis->id_user != $_SESSION['id_user']) {
  //       redirect('wikis');
  //     }

  //     if ($this->wikiModel->archiveWiki($id)) {
  //       redirect('wikis');
  //     } else {
  //       die('Something went wrong');
  //     }
  //   } else {
  //     redirect('wikis');
  //   }
  // }

  public function search($query)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (empty($query)) {
        $wikis = $this->wikiModel->getWiki();
      } else {
        $wikis = $this->wikiModel->searchWiki($query);
      }
      $data = json_encode($wikis);
      echo $data;
    }
  }


  public function archive($wikiId)
  {
    $wikis = $this->wikiModel->archiveWiki($wikiId);
    // Check for owner
    if ($wikis->id_user != $_SESSION['id_user']) {
      redirect('wikis');
    }

    if ($this->wikiModel->archiveWiki($wikiId)) {
      // Redirect or handle success
      redirect('wikis/index');
    } else {
      // Handle failure
      redirect('wikis/index');
      die('Failed to archive the wiki.');
    }
  }

  // public function search()
  // {
  //   if (isset($_POST['input'])) {
  //     $input = $_POST['input'];

  //     $wikis = $this->wikiModel->found_wiki($input);


  //     foreach ($wikis as $wiki) {
  //       echo '<div  class="flex flex-col g-10 border-b-2 pb-8 border-gray-400">';
  //       echo '<h2 class="text-4xl font-bold mt-4 mb-2">' . $wiki->Title . '</h2>';
  //       echo '<p class="text-gray-700 mb-4">' . $wiki->Content . '.</p>';

  //       if (!empty($wiki->TagNames)) {
  //         echo '<div class="flex flex-wrap gap-2 mt-4">';
  //         $tags = explode(", ", $wiki->TagNames);
  //         foreach ($tags as $tag) {
  //           echo '<span class="bg-gray-300 p-2 rounded">' . $tag . '</span>';
  //         }
  //         echo '</div>';
  //       }

  //       echo '<div class="mt-4">';
  //       echo '<span class="bg-blue-300 p-2 rounded">' . $wiki->CategoryName . '</span>';
  //       echo '</div>';

  //       // Only show the buttons if the user is authenticated and owns the wiki
  //       echo '<div class="mt-4 ml-auto">';
  //       if ($wiki->AuthorID === $_SESSION['user_id'] && $_SESSION['UserRole'] == 'autheur') {
  //         echo '<a href="' . URLROOT . '/wikis/edit/' . $wiki->WikiID . '" class="bg-green-500 text-white p-2 rounded">Update</a>';
  //         echo '<a href="' . URLROOT . '/wikis/delete/' . $wiki->WikiID . '" class="bg-red-500 text-white p-2 rounded">Delete</a>';
  //       }

  //       if (isset($_SESSION['UserRole']) && $_SESSION['UserRole'] == 'admin') {
  //         echo '<a href="' . URLROOT . '/wikis/archiver/' . $wiki->WikiID . '" class="bg-violet-500 text-white p-2 rounded">Archive</a>';
  //       }
  //       echo '  <a href=" ' . URLROOT . '/wikis/show/' . $wiki->WikiID . '" class="bg-blue-500 text-white p-2 rounded">Show More</a>';

  //       echo '</div>';
  //       echo '</div>';
  //     }
  //     ;
  //   }
  // }

}
