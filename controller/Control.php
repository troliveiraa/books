<?php

/*
 * Classe controladora que gerencia o fluxo de toda a aplicação.
 *
 * @author Thiago Rodrigues
 * @version 1.0 - 23/Nov/2017
 */

require_once("model/Book.php");
require_once("model/BookFactory.php");
require_once("model/Reminder.php");
require_once("model/ReminderFactory.php");


class Controller {

  private $factoryBook;
  private $factoryReminder;

  //Construtor
  public function Controller() {

    $this->factoryBook      = new BookFactory();
    $this->factoryReminder  = new ReminderFactory();

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);

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

      case 'getBooksInBDForAutoComplete':
        $this->getBooksInBDForAutoComplete();
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
      $nameBook = trim(strip_tags($_POST['name']));
      $hour = trim(strip_tags($_POST['time']));

      //verifica se os checkboxs dos dias da semana foi ativado
      $seg = trim(strip_tags(isset($_POST["seg"]))) ? $_POST["seg"] : "";
      $ter = trim(strip_tags(isset($_POST["ter"]))) ? $_POST["ter"] : "";
      $qua = trim(strip_tags(isset($_POST["qua"]))) ? $_POST["qua"] : "";
      $qui = trim(strip_tags(isset($_POST["qui"]))) ? $_POST["qui"] : "";
      $sex = trim(strip_tags(isset($_POST["sex"]))) ? $_POST["sex"] : "";
      $sab = trim(strip_tags(isset($_POST["sab"]))) ? $_POST["sab"] : "";
      $dom = trim(strip_tags(isset($_POST["dom"]))) ? $_POST["dom"] : "";

      try {

        $days = $seg . " " . $ter . " " . $qua . " " . $qui . " " . $sex . " " . $sab . " " . $dom;

        if ($nameBook == "" || $hour == "")
          throw new Exception('Erro');

        $reminder = new Reminder(0, $nameBook, $hour, $days);

        var_dump($this->factoryReminder->listReminderInBD());

        $result = $this->factoryReminder->registerNewReminderInBD($reminder);
        var_dump($result);

        if (count($result) > 0)
          echo 'inserido com sucessor no bd!';


      }
      catch (Exception $e) {
        $msg = "";
        if ($nameBook == "") {
          $msg = "O campo <strong>Nome</strong> do livro deve ser preenchido!";
        }
        else if ($hour == "") {
          $msg = "O campo de horas deve ser preenchido!";
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
    $result = $this->factoryBook->listBooksInBD();
    require 'view/listBooks.php';
  }

  public function getBooksInBDForAutoComplete() {
    if (isset($_POST['query'])) {
      $name = addslashes($_POST['query']);
      $result = $this->factoryBook->queryBookInBDForAutoComplete($name);

      $output = '<ul class="list-unstyled">';

      foreach($result as $listBooksInBD){
         $output .= '<li>'.$listBooksInBD->getName().'</li>';
      }
      $output .= '</ul>';
      echo $output;
    }

  }

  public function uploadImageOfBook($file) {

    //pasta que ficara salvo a imagem
    $folder		= 'view/img/';

    //requisitos de upload
    $permite 	= array('image/jpeg', 'image/png');
    $maxSize	= 1024 * 1024 * 5; //5 MB

    $fileName = $file['name'];
    $type	    = $file['type'];
    $size	    = $file['size'];
    $error	  = $file['error'];
    $tmpName	= $file['tmp_name'];

    //salva a extensão do arquivo e gera um novo nome para ele
    $ext = @end(explode('.', $fileName));
    $newName = rand().".$ext";

    //MENSAGENS
    $msg		= array();
    $errorMsg	= array(
      1 => '
              O arquivo no upload é maior do que o limite definido em
              upload_max_filesize no php.ini.
           ',
      2 => '
              O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE
              que foi especificado no formulário HTML
            ',
      3 => '
              O upload do arquivo foi feito parcialmente.
           ',
      4 => '
              Não foi feito o upload do arquivo.
           '
    );

    if($error != 0)
      echo $msg[] = "<b>$fileName :</b> ".$errorMsg[$error];
    else if(!in_array($type, $permite))
      echo $msg[] = "<b>$fileName :</b> Erro arquivo não suportado!";
    else if($size > $maxSize)
      echo $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
    else{

      if(move_uploaded_file($tmpName, $folder.'/'.$newName)){
        return $newName;
      }
      else {
        return NULL;
      }
    }
  }

  public function registerNewBook() {

    if (isset($_POST['Registrar'])) {

      $image = '';
      // verifica se foi enviado uma foto do livro
      if (isset( $_FILES['image']['name'] ) && $_FILES['image']['error'] == 0 )
        $image = $this->uploadImageOfBook($_FILES['image']);

      $name = trim(strip_tags($_POST['name']));
      $qtdPages = trim(strip_tags($_POST['qtdPages']));

      try {

        //se nao for
        if (empty($name) || empty($qtdPages))
          throw new Exception('Erro');

        $book = new Book(0, $name, $qtdPages, $image);

        // consulta o nome do livro no banco se o resultado for igual a 0 itens, então
        // é registrado o livro
        if (count($this->factoryBook->queryBookInBD($book->getName())) == 0){

          $result = $this->factoryBook->registerNewBookInBD($book);
          var_dump($result);

          if (count($result) > 0)
            echo 'inserido com sucessor no bd!';


        }
        else{
          echo 'livro já cadastrado!';
        }


      }
      catch (Exception $e) {
        if ($name == "") {
          $msg = "O campo <strong>Nome</strong> do livro deve ser preenchido!";
        }
        else if ($qtdPages == "") {
          $msg = "O campo de quantidade de páginas deve ser preenchido!";
        }
        //echo $msg;
      }
    }
  }
}

?>
