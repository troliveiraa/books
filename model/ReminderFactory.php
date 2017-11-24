<?php

  require_once("model/AbstractFactory.php");

  Class ReminderFactory extends AbstractFactory{


    public function ReminderFactory(){
      $this->AbstractFactory();

    }


    public function registerNewReminderInBD($param){
      var_dump($param);

      $nameBook = $param->getNameBook();
      $hour     = $param->getHour();
      $days     = $param->getDays();

      $sql = "INSERT INTO reminder (nameBook, hour, days) VALUES (:nameBook, :hour, :days)";
      $stmt = $this->db->prepare($sql);

      // Bind parameters to statement variables
      $stmt->bindParam(':nameBook', $nameBook, PDO::PARAM_STR);
      $stmt->bindParam(':hour', $hour, PDO::PARAM_STR);
      $stmt->bindParam(':days', $days, PDO::PARAM_STR);

      $stmt->execute();

      $qtd = $stmt->rowCount();

      // Execute statement
      return $qtd;

    }

    public function listReminderInBD(){

      $result = $this->db->query("SELECT * FROM reminder ORDER BY id DESC");
      return $this->queryRowsToListOfObjects($result, "Reminder");

    }


    public function removeReminderInBD($param){

      $id = $param;

      $sql = "DELETE FROM reminder WHERE id = :id";
      $stmt = $this->db->prepare($sql);

      // Bind parameters to statement variables
      $stmt->bindParam(':id', $id);

      // Execute statement
      $stmt->execute();

      return $stmt->rowCount();
    }

  }
?>
