<?php include ('includes/header.php');?>

  <div class="col-xs-6 col-sm-4"></div>

  <div class="col-xs-6 col-sm-4">
    <div id="ret"></div>
    <form action="" id="form" enctype="multipart/form-data" method="post">

      <legend>Registro de um novo livro</legend>
      <div class="form-group">
        <label for="image">Foto de capa</label>
        <input type="file" name="image" class="form-control-file" id="image" accept="image/*">
        <img id="image_preview" style="display:none;" src="">
        <small id="fileHelp" class="form-text text-muted">
          Escolha a foto do livro em seu computador nos formatos .png e .jpg.
        </small>
      </div>

      <div class="form-group">
      	<label for="name">Nome</label>
      	<input class="form-control" type="text" name="name"  id="name" placeholder="Digite aqui o nome do livro" required><br>
      </div>

      <div class="form-group">
      	<label for="qtdPages">Quantidade de páginas</label>

      	<input class="form-control" type="number" name="qtdPages" id="qtdPages"  min="1" placeholder="Digite aqui a quantidade de páginas do livro" required><br><br>
      	<input class="btn btn-success font-weight-bold" type="submit" name="Registrar" id="Registrar" value="Registrar">
      </div>

  </form>
  </div>

  <div class="col-xs-6 col-sm-4"></div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
  <script type="text/javascript" src="view/js/forwardsControlFormBook.js"></script>

<?php include ('includes/footer.php');?>
