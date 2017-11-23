<?php

/*
 * Classe controladora que gerencia o fluxo de toda a aplicação.
 *
 * @author Thiago Rodrigues
 * @version 1.0 - 23/Nov/2017
 */


class Controller {

  //Construtor
  public function Controller() {

  }
  public function init() {
    if (isset($_GET['op'])) {
      $op = $_GET['op'];
    }
    else {
      $op = "";
    }
    switch ($op) {
      case 'pageNewBook':
        $this->redirectPageNewBook();
        break;

      case 'registerNewBook':
        $this->registerNewBook();
        break;

      case 'pageListBooks':
        $this->redirectPageListBooks();
        break;

      case 'pageNewReminder':
        $this->redirectPageNewReminder();
        break;
      case 'registerNewReminder':
        $this->registerNewReminder();
        break;

      case 'pageListReminder':
        $this->redirectListNewReminder();
        break;

      default:
        $this->redirectPageIndex();
        break;
    }
  }

  public function registerNewReminder() {

    if (isset($_POST['RegistrarLembrete'])) {
      $name = $_POST['name'];
      $time = $_POST['time'];

      //verifica se os checkboxs dos dias da semana foi ativado
      $seg = isset($_POST["seg"]) ? $_POST["seg"] : "";
      $ter = isset($_POST["ter"]) ? $_POST["ter"] : "";
      $qua = isset($_POST["qua"]) ? $_POST["qua"] : "";
      $qui = isset($_POST["qui"]) ? $_POST["qui"] : "";
      $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
      $sab = isset($_POST["sab"]) ? $_POST["sab"] : "";
      $dom = isset($_POST["dom"]) ? $_POST["dom"] : "";

      try {
        echo $name;
        echo $time;

        echo $seg;
        echo $ter;
        echo $qua;
        echo $qui;
        echo $sex;
        echo $sab;
        echo $dom;

      }
      catch (Exception $e) {
        if ($name == "") {
          $msg = "O campo <strong>Nome</strong> deve ser preenchido!";
        }
        else if ($email == "") {
          $msg = "O campo de quantidade de páginas deve ser preenchido!";
        }
        echo $msg;
      }
    }
  }

  public function redirectPageIndex() {
    require 'view/index.php';
  }

  public function redirectPageNewBook() {
    require 'view/newBook.php';
  }

  public function redirectPageNewReminder() {
    require 'view/newReminder.php';
  }

  public function redirectPageListBooks() {
    require 'view/listBooks.php';
  }

  public function registerNewBook() {

    if (isset($_POST['Registrar'])) {

      // verifica se foi enviado uma foto do livro
      if (isset( $_FILES['image']['name'] ) && $_FILES['image']['error'] == 0 ) {

        echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'image' ][ 'name' ] . '</strong><br />';
        echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'image' ][ 'type' ] . ' </strong ><br />';
        echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'image' ][ 'tmp_name' ] . '</strong><br />';
        echo 'Seu tamanho é: <strong>' . $_FILES[ 'image' ][ 'size' ] . '</strong> Bytes<br /><br />';


        $destino = 'view/img/' . $_FILES['image']['name'];
        $arquivo_tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($arquivo_tmp, $destino);
      }

      $name = $_POST['name'];
      $qtdPages = $_POST['qtdPages'];

      $sucesso = false;
      try {
        echo $name.$qtdPages;

      }
      catch (Exception $e) {
        if ($name == "") {
          $msg = "O campo <strong>Nome</strong> deve ser preenchido!";
        }
        else if ($email == "") {
          $msg = "O campo de quantidade de páginas deve ser preenchido!";
        }
        echo $msg;
      }
    }
  }  
}

?>
