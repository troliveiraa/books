<?php include ('includes/header.php');?>

  <div class="col-xs-6 col-sm-4"></div>

  <div class="col-xs-6 col-sm-4">

    <form action="?op=registerNewBook" enctype="multipart/form-data"  method="post">
      <legend>Registro de um novo livro</legend>

      <div class="form-group">
        <label for="image">Foto de capa</label>
        <input type="file" name="image" class="form-control-file" id="image">
        <small id="fileHelp" class="form-text text-muted">Escolha a foto de capa em seu computador.</small>
      </div>

      <div class="form-group">
      	<label for="name">Nome</label>
      	<input class="form-control" type="text" name="name"  id="name"  placeholder="Digite aqui o nome do livro"><br>
      </div>

      <div class="form-group">
      	<label for="qtdPages">Quantidade de páginas</label>

      	<input class="form-control" type="number" name="qtdPages" id="qtdPages"  min="1" placeholder="Digite aqui a quantidade de páginas do livro" ><br><br>
      	<input class="btn btn-success font-weight-bold" type="submit" name="Registrar" value="Registrar">
      </div>

  </form>
  </div>

  <div class="col-xs-6 col-sm-4"></div>

<?php include ('includes/footer.php');?>
