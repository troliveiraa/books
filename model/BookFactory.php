<?php

  require_once("model/AbstractFactory.php");

  Class BookFactory extends AbstractFactory{


    public function BookFactory(){
      $this->AbstractFactory();

    }


    public function registerNewBookInBD($param){

      $name     = $param->getName();
      $qtdPages = $param->getQtdPages();
      $image    = $param->getImage();

      echo $name.$qtdPages.$image;

      $sql = "INSERT INTO book (name, qtdPages, image) VALUES (:name, :qtdPages, :image)";
      $stmt = $this->db->prepare($sql);

      // Bind parameters to statement variables
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':qtdPages', $qtdPages, PDO::PARAM_STR);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);

      $stmt->execute();

      var_dump($stmt->rowCount());

      // Execute statement
      return $stmt->rowCount();

    }

    public function listBooksInBD(){

      $result = $this->db->query('SELECT * FROM book ORDER BY id DESC');
      return $this->queryRowsToListOfObjects($result, "Book");

    }
    public function queryBookInBD($name){

      $sql = "SELECT * FROM book WHERE name = :name";
      $stmt = $this->db->prepare($sql);

      // Bind parameters to statement variables
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);

      // Execute statement
      $stmt->execute();

      $list =  $this->queryRowsToListOfObjects($stmt, "Book");

      return $list;

    }

    public function queryBookInBDForAutoComplete($name){

      $sql = "SELECT * FROM book WHERE name LIKE '%".$name."%'";
      $stmt = $this->db->prepare($sql);

	    $stmt->execute();

      $list =  $this->queryRowsToListOfObjects($stmt, "Book");
      return $list;
      
    }
    public function removeBookInBD($param){

      $id = $param;

      $sql = "DELETE FROM book WHERE id = :id";
      $stmt = $this->db->prepare($sql);

      // Bind parameters to statement variables
      $stmt->bindParam(':id', $id);

      // Execute statement
      $stmt->execute();

      return $stmt->rowCount();


    }

  }
?>
