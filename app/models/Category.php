<?php
  class Category {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCategory(){
      $this->db->query('SELECT * FROM categories 
      INNER JOIN users 
      where users.UserID = categories.Created_AdminID;
      ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addCategory($data){
      $this->db->query('INSERT INTO categories (CategoryName, Created_AdminID) VALUES(:CategoryName, :Created_AdminID)');
      // Bind values
      $this->db->bind(':CategoryName', $data['CategoryName']);
      $this->db->bind(':Created_AdminID', $_SESSION['id_user']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function editCategory($data){
      $this->db->query('UPDATE categories SET CategoryName = :CategoryName WHERE CategoryID  = :CategoryID ');
      // Bind values
      $this->db->bind(':CategoryID ', $data['CategoryID ']);
      $this->db->bind(':CategoryName', $data['CategoryName']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getCategoryById($id){
      $this->db->query('SELECT * FROM categories WHERE CategoryID  = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteCategory($id){
      $this->db->query('DELETE FROM categories WHERE CategoryID  = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getTotalCategories()
    {
      $this->db->query("SELECT COUNT(*) AS total_categories FROM categories");
      
      $row = $this->db->single();
      
      return $row;
    }
  
    
    
  }