<?php

  Class Reminder{

    public $id;
    public $nameBook;
    public $hour;
    public $days;

    public function Reminder($id, $nameBook, $hour, $days){
      $this->id       = $id;
      $this->nameBook = $nameBook;
      $this->hour     = $hour;
      $this->days     = $days;
    }

    public function getId(){
      return $this->id;
    }

    public function getNameBook(){
      return $this->nameBook;
    }

    public function getHour(){
      return $this->hour;
    }

    public function getDays(){
      return $this->days;
    }
  }

?>
