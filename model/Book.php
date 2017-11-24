<?php

  Class Book{

    public $id;
    public $name;
    public $qtdPages;
    public $image;

    public function Book($id, $name, $qtdPages, $image){
      $this->id = $id;
      $this->name = $name;
      $this->qtdPages = $qtdPages;
      $this->image = $image;
    }

    public function getId(){
      return $this->id;
    }

    public function getName(){
      return $this->name;
    }

    public function getQtdPages(){
      return $this->qtdPages;
    }

    public function getImage(){
      return $this->image;
    }

  }

?>
