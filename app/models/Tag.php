<?php
  class Tag {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTag(){
      $this->db->query('SELECT * FROM tags INNER JOIN users where users.UserID = tags.created_id');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addTag($data){
      $this->db->query('INSERT INTO tags (TagName, created_id) VALUES(:TagName, :created_id)');
      // Bind values
      $this->db->bind(':TagName', $data['TagName']);
      $this->db->bind(':created_id', $_SESSION['id_user']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function editTag($data){
      $this->db->query('UPDATE tags SET TagName = :TagName WHERE TagID  = :TagID');
      // Bind values
      $this->db->bind(':TagID', $data['TagID']);
      $this->db->bind(':TagName', $data['TagName']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getTagById($id){
      $this->db->query('SELECT * FROM tags WHERE TagID  = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteTag($id){
      $this->db->query('DELETE FROM tags WHERE TagID  = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    
  public function getTotalTags()
  {
    $this->db->query("SELECT COUNT(*) AS total_tags FROM tags");
    
    $row = $this->db->single();

    
    return $row;
  }
  
  }