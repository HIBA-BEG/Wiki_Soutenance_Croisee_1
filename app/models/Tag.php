<?php
class Tag
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getTag()
  {
    $this->db->query('SELECT * FROM tags INNER JOIN users where users.UserID = tags.created_id');

    $results = $this->db->resultSet();

    return $results;
  }

  public function addTag($data)
  {
    $this->db->query('INSERT INTO tags (TagName, created_id) VALUES(:TagName, :created_id)');
    // Bind values
    $this->db->bind(':TagName', $data['TagName']);
    $this->db->bind(':created_id', $_SESSION['id_user']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function editTag($data)
  {
    $this->db->query('UPDATE tags SET TagName = :TagName WHERE TagID  = :TagID');
    // Bind values
    $this->db->bind(':TagID', $data['TagID']);
    $this->db->bind(':TagName', $data['TagName']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getTagByID($id)
  {
    $this->db->query('SELECT * FROM tags WHERE TagID = :TagID');
    $this->db->bind(':TagID', $id);

    return $this->db->single();
  }

  public function deleteTag($id)
  {
    $this->db->query('DELETE FROM tags WHERE TagID  = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
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
  public function add_wiki_tags($id, $tags)
  {
    // Ensure $tags is an array before proceeding
    if (!is_array($tags)) {
      // Handle the situation where $tags is not an array (it might be null or something else)
      echo "Invalid tags data.";
      return false;
    }

    foreach ($tags as $tag) {
      // Assuming your table is named "tags" with columns "tag_id" and "name"
      $this->db->query("INSERT INTO wikitags (WikiID,TagID) VALUES (:WikiID,:TagID)");
      $this->db->bind(':WikiID', $id);
      $this->db->bind(':TagID', $tag);
      $this->db->execute();
    }

    echo "Records inserted successfully.";
  }

  public function get_tags_wiki($id)
  {
    $this->db->query('SELECT * FROM tags join wikitags on wikitags.TagID = tags.TagID WHERE wikitags.WikiID=:WikiID');
    $this->db->bind(':WikiID', $id);

    $row = $this->db->resultSet();

    return $row;
  }

  public function delete_tags($id)
  {
    try {
      $this->db->query('DELETE FROM wikitags WHERE WikiID  = :WikiID');
      $this->db->bind(':WikiID', $id);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
    }

  }

}