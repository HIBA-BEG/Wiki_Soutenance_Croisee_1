<?php
class Wiki
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getWiki()
  {
    $this->db->query('SELECT * ,categories.CategoryName FROM wikis 
      INNER JOIN users on users.UserID = wikis.AuthorID 
      inner join categories on categories.CategoryID = wikis.CategoryID 
      where isArchived = 0
      ORDER by wikis.LastModifiedDate desc
      ');

    $results = $this->db->resultSet();

    return $results;
  }
  public function getTagSWiki($wikiId){
    $this->db->query('SELECT * ,categories.CategoryName FROM wikis 
    INNER JOIN users on users.UserID = wikis.AuthorID 
    INNER join categories on categories.CategoryID = wikis.CategoryID 
    INNER join wikitags on wikis.WikiID = wikitags.WikiID 
    INNER join tags on tags.TagID = wikitags.TagID 
    ORDER by wikis.LastModifiedDate ASC;

    ');
    $results = $this->db->resultSet();
    return $results;
  }

  public function addWiki($data)
  {
    $this->db->query('INSERT INTO wikis (Title, Content, CreationDate, LastModifiedDate, AuthorID, CategoryID) VALUES(:Title, :Content, :CreationDate, :LastModifiedDate, :AuthorID, :CategoryID)');
    // Bind values
    $this->db->bind(':Title', $data['Title']);
    $this->db->bind(':Content', $data['Content']);
    $this->db->bind(':CreationDate', $data['CreationDate']);
    $this->db->bind(':LastModifiedDate', $data['LastModifiedDate']);
    $this->db->bind(':AuthorID', $_SESSION['id_user']);
    $this->db->bind(':CategoryID', $data['CategoryID']);

    // Execute
    if ($this->db->execute()) {
      // Get the last inserted ID
      $lastInsertId = $this->db->lastInsertId();
      return $lastInsertId;
    } else {
      return false;
    }
  }
  public function get_tags_wiki($id)
  {
    $this->db->query('SELECT * FROM tags join wikitags on wikitags.TagID = tags.TagID WHERE wikitags.WikiID=:WikiID');
    $this->db->bind(':WikiID', $id);

    $row = $this->db->resultSet();

    return $row;
  }

  public function editWiki($id,$data)
  {
    $this->db->query('UPDATE wikis SET Title = :Title, Content = :Content, LastModifiedDate = :LastModifiedDate, CategoryID = :CategoryID WHERE WikiID  = :WikiID');
    // Bind values
    $this->db->bind(':WikiID', $id);
    $this->db->bind(':Title', $data['Title']);
    $this->db->bind(':Content', $data['Content']);
    $this->db->bind(':LastModifiedDate', $data['LastModifiedDate']);
    $this->db->bind(':CategoryID', $data['CategoryID']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getWikiById($id)
  {
    $this->db->query('SELECT * FROM wikis JOIN users on users.UserID = wikis.AuthorID JOIN categories ON wikis.CategoryID = categories.CategoryID WHERE wikis.WikiID = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function deleteWiki($id)
  {
    $this->db->query('DELETE FROM wikis WHERE WikiID  = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function archiveWiki($WikiID)
  {
    $this->db->query('UPDATE wikis SET isArchived	 = 1 WHERE WikiID  = :WikiID');
    // Bind values
    $this->db->bind(':WikiID', $WikiID);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  public function getTotalWikis()
  {
    $this->db->query("SELECT COUNT(*) AS total_wikis FROM wikis");

    $row = $this->db->single();

    return $row;
  }

  public function searchWiki($query)
  {
    $this->db->query("SELECT wikis.* , categories.CategoryName from wikis Join categories on wikis.CategoryID = categories.CategoryID where wikis.Title like :query OR categories.CategoryName like :query and isArchived=0 ");
    $this->db->bind('query', '%' . $query . '%');
    $this->db->execute();
    return $this->db->resultSet();

  }


}