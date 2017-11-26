<?php

/*
 * Classe controladora que gerencia o fluxo da aplicação.
 *
 * @author Thiago Rodrigues
 * @version 3.0 - 25/Nov/2017
 */

// Arquivo onde fica a classe que abstrai um livro.
require_once("model/Book.php");

/*
  Arquivo onde fica a classe que faz toda a persistência de dados no BD referente
  aos objetos do tipo livro.
*/
require_once("model/BookFactory.php");

// Arquivo onde fica a classe que abstrai um lembrete.
require_once("model/Reminder.php");

/*
  Arquivo onde fica a classe que faz toda a persistência de dados no BD referente
  aos objetos do tipo lembrete.
*/
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
    /*
      verifica a opção de navegação na aplicação, baseado nela o Controller
      redireciona para o método correspondente.
    */
    if (isset($_GET['op'])) $op = $_GET['op'];
    else $op = "";


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

      default:
        $this->redirectPageIndex();
        break;
    }
  }

  /*
    Método responsável por redirecionar para a página incial da aplicação.
  */
  public function redirectPageIndex() {
    require 'view/index.php';
  }

  /*
    Método responsável por redirecionar para a página que permite o usuário
    registrar um livro.
  */
  public function redirectPageNewBook() {
    require 'view/newBook.php';
  }

  /*
    método responsável por redirecionar para a página que permite o usuário
    registrar um lembrete.
 */
  public function redirectPageNewReminder() {
    require 'view/newReminder.php';
  }

  /*
    método responsável por redirecionar para a página que permite ao usuário
    verificar todos os livros registrados.
  */
  public function redirectPageListBooks() {
    $result = $this->factoryBook->listBooksInBD();
    require 'view/listBooks.php';
  }

  public function registerNewReminder() {

    /*
      verifica se recebeu o nome do livro e quantidade de páginas do livro
      e os dias de repetição do lembrete anexados na requisição pelo ajax.
    */

    if (isset($_POST['RegistrarLembrete'])) {

      // recupera os dados do formulário
      $nameBook = trim(strip_tags($_POST['name']));
      $hour = trim(strip_tags($_POST['time']));
      $days = trim(strip_tags($_POST['days']));

      try {

        // cria um objeto do tipo lembrete
        $reminder = new Reminder(0, $nameBook, $hour, $days);

        // verifica se o nome do livro informado está registrado no BD
        $listBooks = $this->factoryBook->queryBookInBD($reminder->getNameBook());
        if (count($listBooks) > 0){
          // caso o livro esteja registrado entao registra o lembrete.
          $result = $this->factoryReminder->registerNewReminderInBD($reminder);
          if (count($result) > 0)
            echo '<p style="color:green;">Lembrete registrado com sucesso!</p>@'.$listBooks[0]->getImage();
        }
        else{
          echo '<p style="color:red;">Esse livro não existe!</p>@not';
        }
      }
      catch (Exception $e) {
        echo $e;
      }
    }
  }

  public function getBooksInBDForAutoComplete() {

    /*
      verifica se recebeu uma requisição do ajax para dar sujestão
      de nomes de livros baseado em cadeias de caracteres digitado pelo
      usuário.
    */
    if (isset($_POST['query'])) {

      //recupera a cadeia de caracteres
      $name = addslashes($_POST['query']);
      // procura no BD livros que tenho substrings que casam com o nome do livro.
      $result = $this->factoryBook->queryBookInBDForAutoComplete($name);

      //cria uma lista em html com os livros retornado pela consulta.
      $output = '<ul class="list-unstyled">';
      foreach($result as $listBooksInBD){
         $output .= '<li>'.$listBooksInBD->getName().'</li>';
      }
      $output .= '</ul>';
      echo $output;
    }

  }

  public function registerNewBook() {

    // verifica se recebeu uma requisição do ajaxForm
    if (isset($_POST)) {

      /*
        caso o usuário escolheu registrar o livro com uma Foto;
        verifica se essa foto veio pelo ajaxForm
      */
      $image = '';
      if (isset($_FILES['image'])){

        // pasta onde as imagens ficam armazenadas
        $folder		= 'view/img/';

        // recupera o nome temporário na memória e o nome real.
    		$fileTmpName = $_FILES['image']['tmp_name'];
    		$fileName = $_FILES['image']['name'];

    		//salva a extensão do arquivo e gera um novo nome para ele
    		$ext = @end(explode('.', $fileName));
    		$newName = rand().".$ext";

        // copia a imagem para a pasta onde as imagens ficam armazenadas
    		if (copy($fileTmpName, $folder.$newName)){
          /*
            atribui essa variável para receber o novo nome e ser inserido no BD
            junto com o nome e quantidade de páginas do livro.
          */
          $image = $newName;
    			echo 'Imagem carregada ao servidor com sucesso!';
    		}
    		else {
    			echo 'Falha ao carregar a imagem ao servidor!';
    		}
    	}

      /*
        verifica se recebeu o nome do livro e quantidade de páginas do livro
        anexados na requisição pelo ajaxForm.
      */
      if(isset($_POST['name']) && isset($_POST['qtdPages'])){

        // recupera os dados do formulário
        $name = trim(strip_tags($_POST['name']));
        $qtdPages = trim(strip_tags($_POST['qtdPages']));

        try {
          // cria um objeto do tipo livro
          $book = new Book(0, $name, $qtdPages, $image);

          /*
            consulta o nome do livro no banco se o resultado for igual a 0 itens, então
            o livro é registrado.
          */
          if (count($this->factoryBook->queryBookInBD($book->getName())) == 0){
            $result = $this->factoryBook->registerNewBookInBD($book);

            if (count($result) > 0)
              echo '<p style="color:green;">Livro registrado com sucesso!</p>';
          }
          else{
            echo '<p style="color:red;">Livro já cadastrado!</p>';
          }
        }
        catch (Exception $e) {
          echo $msg;
        }
      }
      else{
        /*
          se não recebeu o nome e a quantidade de páginas do livro
          mandados pelo ajaxForm, escreve uma mensagem de erro no
          buffer de resposta ao usuário.
        */

        if(isset($_POST['name']) == ""){
           echo '<p style="color:red;">Digite o nome do livro! </p>';
        }
        if(isset($_POST['qtdPages']) == ""){
          echo '<p style="color:red;">Digite a quantidade de páginas do livro!</p>';
        }
      } //fim else
    }
  }
}

?>
