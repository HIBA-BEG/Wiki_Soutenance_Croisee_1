<?php
  class Wiki {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getWiki(){
      $this->db->query('SELECT * FROM wikis 
      INNER JOIN users 
      where users.UserID = wikis.AuthorID 
      ORDER by wikis.LastModifiedDate ASC;
      ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addWiki($data){
      $this->db->query('INSERT INTO wikis (Title, Content, creation_date, LastModifiedDate, AuthorID) VALUES(:Title, :Content, :creation_date, :LastModifiedDate, :AuthorID)');
      // Bind values
      $this->db->bind(':Title', $data['Title']);
      $this->db->bind(':Content', $data['Content']);
      $this->db->bind(':creation_date', $data['creation_date']);
      $this->db->bind(':LastModifiedDate', $data['LastModifiedDate']);
      $this->db->bind(':AuthorID', $_SESSION['id_user']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function editWiki($data){
      $this->db->query('UPDATE wikis SET Title = :Title, Content = :Content, LastModifiedDate = :LastModifiedDate WHERE WikiID  = :WikiID ');
      // Bind values
      $this->db->bind(':WikiID ', $data['WikiID ']);
      $this->db->bind(':Title', $data['Title']);
      $this->db->bind(':Content', $data['Content']);
      $this->db->bind(':LastModifiedDate', $data['LastModifiedDate']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getWikiById($id){
      $this->db->query('SELECT * FROM wikis WHERE WikiID  = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteWiki($id){
      $this->db->query('DELETE FROM wikis WHERE WikiID  = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
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

  
  }