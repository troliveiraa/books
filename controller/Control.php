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
        /*if ($nome == "" || $email == "") throw new Exception('Erro');
        $contato = new Contato(0, $nome, $email);

        //consulta o e-mail no banco
        $result = $this->factory->buscar($contato->getEmail());

        // se o resultado for igual a 0 itens, então salva contato
        if (count($result) == 0) {
          $sucesso = $this->factory->salvar($contato);
        }*/

        /*if ($sucesso) {
          $msg = '<div class="alert alert-success" role="alert">O contato ' . $contato->getNome() . ' (' . $contato->getEmail(). ') foi cadastrado com sucesso!</div>';
        }
        else if (!$sucesso && count($result) > 0) {
          $msg = '<div class="alert alert-warning" role="alert">O contato n&atilde;o foi adicionado. E-mail j&aacute; existente na agenda!</div>';
        }
        else {
          $msg = '<div class="alert alert-danger" role="alert">O contato n&atilde;o foi adicionado. Tente novamente mais tarde!</div>';
        }

        unset($nome);
        unset($email);

        $refresh = 1;
		    $adress = '?op=novo';

        require 'View/mensagem.php';*/
      }
      catch (Exception $e) {
        if ($name == "") {
          $msg = "O campo <strong>Nome</strong> deve ser preenchido!";
        }
        else if ($email == "") {
          $msg = "O campo de quantidade de páginas deve ser preenchido!";
        }
        echo $msg;

        /*$refresh = 1;
		    $adress = '?op=novo';
        require 'View/mensagem.php';*/
      }
    }
  }



  public function lista() {
    $result = $this->factory->listar();
    require 'View/lista.php';
  }

  public function remove() {
  	$id = $_GET['id'];

    $result = $this->factory->remove($id);

  	if($result){
      $refresh = 1;
  	  $adress = '?op=lista';

  	  $msg = '<div class="alert alert-success" role="alert">O contato foi excluido com sucesso!</div>';
  	  require 'View/mensagem.php';
  	}
    else{
	     $msg = '<div class="alert alert-danger" role="alert">O contato n&atilde;o foi excluido. Tente novamente mais tarde!</div>';
       require 'View/mensagem.php';
    }
  }
  public function out() {
    session_start('EmailContato');
    session_destroy();

    require 'View/index.php';
  }
}

?>
